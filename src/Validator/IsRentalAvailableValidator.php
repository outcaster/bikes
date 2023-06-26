<?php

declare(strict_types=1);

namespace App\Validator;

use App\Entity\Rental;
use App\Repository\RentalRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsRentalAvailableValidator extends ConstraintValidator
{
    public function __construct(
        private readonly RentalRepository $rentalRepository
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        /**
         * @var Rental $object
         */
        $object = $this->context->getObject();

        $rentals = $this
            ->rentalRepository
            ->getOccupiedRentals($object->getBike(), $object->getDateStart(), $object->getDateEnd());

        if ($rentals > 0) {
            $this->context
                ->buildViolation('Rental is not available in selected date range')
                ->addViolation();
        }
    }
}
