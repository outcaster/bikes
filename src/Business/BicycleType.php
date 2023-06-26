<?php

declare(strict_types=1);

namespace App\Business;

enum BicycleType: string
{
    case NORMAL = 'NORMAL';
    case OLD = 'OLD';
    case ELECTRIC = 'ELECTRIC';
}
