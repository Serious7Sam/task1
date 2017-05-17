<?php

namespace Tests\Unit\Operation;

use Collection\OfferCollection;
use Entity\Offer;
use Entity\Restaurant;
use Operation\CalculatePriceForMealsInRestaurant;
use PHPUnit\Framework\TestCase;

class CalculatePriceForMealsInRestaurantTest extends TestCase
{
    public function testExecute()
    {
        $offers = [
            new Offer(10, ['5', '3']),
            new Offer(5.5, ['1', '2', '5']),
            new Offer(6.5, ['4', '2', '1']),
            new Offer(7, ['2', '3', '4']),
        ];

        $restaurant = new Restaurant(1, new OfferCollection($offers));

        $calculator = new CalculatePriceForMealsInRestaurant();

        static::assertSame(5.5, $calculator->execute($restaurant, ['1', '2']));
        static::assertSame(12.0, $calculator->execute($restaurant, ['5', '2', '4']));
    }
}
