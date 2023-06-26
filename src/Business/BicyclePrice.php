<?php

declare(strict_types=1);

namespace App\Business;

enum BicyclePrice: int
{
    case NORMAL = 10;
    case PREMIUM = 30;
}
