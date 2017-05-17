<?php

namespace Tests\Unit\Collection;

use Collection\OfferCollection;
use Collection\RestaurantCollection;
use Entity\Restaurant;
use PHPUnit\Framework\TestCase;

class RestaurantCollectionTest extends TestCase
{
    public function testOperationsWithRestaurant()
    {
        $restaurants = [
            1 => new Restaurant(1, new OfferCollection()),
            2 => new Restaurant(2, new OfferCollection()),
        ];

        $collection = new RestaurantCollection();
        $collection->addRestaurant($restaurants[1])
            ->addRestaurant($restaurants[2]);

        static::assertSame($restaurants, $collection->getAll());
        static::assertTrue($collection->has(1));

        $collection->removeRestaurant(1);
        $collection->removeRestaurant(125);

        static::assertFalse($collection->has(1));

        static::assertNull($collection->get(1));
        static::assertSame($restaurants[2], $collection->get(2));
    }
}
