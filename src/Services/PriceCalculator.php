<?php

declare(strict_types=1);

namespace App\Services;

use App\Business\BasePeriod;
use App\Business\BicyclePrice;
use App\Entity\Rental;

class PriceCalculator
{
    /**
     * @throws \Exception
     */
    public function getPrice(Rental $rental): int
    {
        $bike = $rental->getBike();
        $interval = date_diff($rental->getDateStart(), $rental->getDateEnd())->days;
        $days = $interval ? $interval + 1 : 1;
        $basePrice = $bike->isPremium() ? BicyclePrice::PREMIUM->value : BicyclePrice::NORMAL->value;

        /**
         * @var BasePeriod $basePeriod
         */
        $basePeriod = constant('App\Business\BasePeriod::'.$bike->getType());
        $basePeriodValue = $basePeriod->value;

        return $basePrice + max(($days - $basePeriodValue) * $basePrice, 0);
    }
}
