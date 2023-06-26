<?php

namespace App\Tests\Validator;

use App\Entity\Bicycle;
use App\Entity\Rental;
use App\Repository\RentalRepository;
use App\Validator\IsDateRange;
use App\Validator\IsRentalAvailable;
use App\Validator\IsRentalAvailableValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class IsRentalAvailableValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): IsRentalAvailableValidator
    {
        $repository = $this
            ->getMockBuilder(RentalRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('getOccupiedRentals')
            ->willReturn(1);


        return new IsRentalAvailableValidator($repository);
    }

    public function testRentalIsInvalid(): void
    {
        $this->context->setNode(
            'InvalidValue',
            new Rental(new Bicycle('OLD', true),
                new \DateTime(),
                new \DateTime('+3 days')
            ),
            null,
            'property.path'
        );

        $this->validator->validate('InvalidValue', new IsRentalAvailable());

        $this->buildViolation('Rental is not available in selected date range')->assertRaised();
    }
}
