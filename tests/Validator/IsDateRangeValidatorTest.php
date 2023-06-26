<?php

declare(strict_types=1);

namespace App\Tests\Validator;

use App\Entity\Bicycle;
use App\Entity\Rental;
use App\Validator\IsDateRange;
use App\Validator\IsDateRangeValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class IsDateRangeValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): IsDateRangeValidator
    {
        return new IsDateRangeValidator();
    }

    public function testNotInterfacedIsValid(): void
    {
        $this->validator->validate(new \stdClass(), new IsDateRange());

        $this->assertNoViolation();
    }

    public function testRangeIsValid(): void
    {
        $this->validator->validate(
            new Rental(
                new Bicycle('OLD', true),
                new \DateTime(),
                new \DateTime()
            ), new IsDateRange()
        );

        $this->assertNoViolation();
    }

    public function testRangeIsInvalid(): void
    {
        $value = new \DateTime();
        $this->context->setNode(
            'InvalidValue',
            new Rental(new Bicycle('OLD', true),
                $value,
                new \DateTime('-3 days')
            ),
            null,
            'property.path'
        );

        $this->validator->validate('InvalidValue', new IsDateRange());

        $this->buildViolation('Rental end must be after rental start')->assertRaised();
    }
}
