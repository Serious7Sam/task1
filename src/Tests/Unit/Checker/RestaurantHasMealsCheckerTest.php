<?php

namespace Tests\Unit\Checker;

use Checker\RestaurantHasMealsChecker;
use Collection\OfferCollection;
use Entity\Offer;
use Entity\Restaurant;
use PHPUnit\Framework\TestCase;

class RestaurantHasMealsCheckerTest extends TestCase
{
    public function testCheck()
    {
        $checker = new RestaurantHasMealsChecker();

        $offer = new Offer(15.47, ['1', '2']);
        $offers = new OfferCollection();
        $offers->addOffer($offer);
        $restaurant = new Restaurant(1, $offers);

        static::assertFalse($checker->check($restaurant, ['1', '3']));
        static::assertTrue($checker->check($restaurant, ['1', '2']));
    }
}
