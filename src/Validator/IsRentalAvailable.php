<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsRentalAvailable extends Constraint
{
    public string $message = 'Rental is not available on the selected dates';
    public string $mode = 'strict';
}
