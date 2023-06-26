<?php

declare(strict_types=1);

namespace App\Tests\Services;

use App\Entity\Bicycle;
use App\Entity\Rental;
use App\Services\PriceCalculator;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    public static function RentalDataProvider(): array
    {
        return [
            [
                new Rental(
                    new Bicycle('ELECTRIC', true),
                    new \DateTime(),
                    new \DateTime(),
                ),
                30,
            ],
            [
                new Rental(
                    new Bicycle('ELECTRIC', true),
                    new \DateTime(),
                    new \DateTime('+5 days'),
                ),
                180,
            ],
            [
                new Rental(
                    new Bicycle('ELECTRIC', false),
                    new \DateTime(),
                    new \DateTime(),
                ),
                10,
            ],
            [
                new Rental(
                    new Bicycle('ELECTRIC', false),
                    new \DateTime(),
                    new \DateTime('+5 days'),
                ),
                60,
            ],
            [
                new Rental(
                    new Bicycle('NORMAL', true),
                    new \DateTime(),
                    new \DateTime(),
                ),
                30,
            ],
            [
                new Rental(
                    new Bicycle('NORMAL', true),
                    new \DateTime(),
                    new \DateTime('+2 days'),
                ),
                30,
            ],
            [
                new Rental(
                    new Bicycle('NORMAL', true),
                    new \DateTime(),
                    new \DateTime('+3 days'),
                ),
                60,
            ],
            [
                new Rental(
                    new Bicycle('NORMAL', false),
                    new \DateTime(),
                    new \DateTime(),
                ),
                10,
            ],
            [
                new Rental(
                    new Bicycle('NORMAL', false),
                    new \DateTime(),
                    new \DateTime('+2 days'),
                ),
                10,
            ],
            [
                new Rental(
                    new Bicycle('NORMAL', false),
                    new \DateTime(),
                    new \DateTime('+3 days'),
                ),
                20,
            ],
            [
                new Rental(
                    new Bicycle('OLD', true),
                    new \DateTime(),
                    new \DateTime(),
                ),
                30,
            ],
            [
                new Rental(
                    new Bicycle('OLD', true),
                    new \DateTime(),
                    new \DateTime('+3 days'),
                ),
                30,
            ],
            [
                new Rental(
                    new Bicycle('OLD', true),
                    new \DateTime(),
                    new \DateTime('+5 days'),
                ),
                60,
            ],
            [
                new Rental(
                    new Bicycle('OLD', false),
                    new \DateTime(),
                    new \DateTime(),
                ),
                10,
            ],
            [
                new Rental(
                    new Bicycle('OLD', false),
                    new \DateTime(),
                    new \DateTime('+3 days'),
                ),
                10,
            ],
            [
                new Rental(
                    new Bicycle('OLD', false),
                    new \DateTime(),
                    new \DateTime('+5 days'),
                ),
                20,
            ],
        ];
    }

    /**
     * @dataProvider RentalDataProvider
     */
    public function testCalculatePrice(
        Rental $rental,
        int $expectedPrice
    ): void {
        $this->testFunctionality(
            $rental,
            $expectedPrice
        );
    }

    private function testFunctionality(Rental $rental, int $expectedPrice): void
    {
        $obj = new PriceCalculator();
        $price = $obj->getPrice($rental);

        $this->assertEquals($expectedPrice, $price);
    }
}
