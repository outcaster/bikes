<?php

declare(strict_types=1);

namespace App\Business;

enum BasePeriod: int
{
    case ELECTRIC = 1;
    case NORMAL = 3;
    case OLD = 5;
}
