<?php

namespace Tests\Unit\Entity;

use Entity\Offer;
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    public function testGetters()
    {
        $price = 4.6;
        $meals = ['1', '2'];
        $offer = new Offer($price, $meals);

        static::assertSame($price, $offer->getPrice());
        static::assertSame($meals, $offer->getMeals());
        static::assertTrue($offer->hasMeal('1'));
        static::assertFalse($offer->hasMeal('3'));
    }
}
