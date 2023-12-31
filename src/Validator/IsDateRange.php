<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsDateRange extends Constraint
{
    public string $message = 'DateStart must be before DateEnd';
    public string $mode = 'strict';
}
