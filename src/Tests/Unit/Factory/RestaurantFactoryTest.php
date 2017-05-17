<?php

namespace Tests\Unit\Factory;

use Collection\OfferCollection;
use Entity\Restaurant;
use Factory\RestaurantFactory;
use PHPUnit\Framework\TestCase;

class RestaurantFactoryTest extends TestCase
{
    public function testCreate()
    {
        $factory = new RestaurantFactory();
        $id = 5;
        $offers = new OfferCollection();

        static::assertEquals(new Restaurant($id, $offers), $factory->create($id, $offers));
    }
}
