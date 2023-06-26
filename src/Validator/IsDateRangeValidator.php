<?php

declare(strict_types=1);

namespace App\Validator;

use App\Entity\Interfaces\ContainsDateRange;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsDateRangeValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        $object = $this->context->getObject();

        if (!$object instanceof ContainsDateRange) {
            return;
        }

        if ($object->getDateEnd()->getTimestamp() - $object->getDateStart()->getTimestamp() < 0) {
            $this->context
                ->buildViolation('Rental end must be after rental start')
                ->addViolation();
        }
    }
}
