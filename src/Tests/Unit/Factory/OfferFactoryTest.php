<?php

namespace Tests\Unit\Factory;

use Entity\Offer;
use Factory\OfferFactory;
use PHPUnit\Framework\TestCase;

class OfferFactoryTest extends TestCase
{
    public function testCreate()
    {
        $factory = new OfferFactory();
        $price = 1.5;
        $meals = ['1', '2'];

        static::assertEquals(new Offer($price, $meals), $factory->create($price, $meals));
    }
}
