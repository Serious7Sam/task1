<?php

namespace Tests\Unit\Factory;

use Collection\RestaurantCollection;
use Factory\RestaurantCollectionFactory;
use PHPUnit\Framework\TestCase;

class RestaurantCollectionFactoryTest extends TestCase
{
    public function testCreate()
    {
        $factory = new RestaurantCollectionFactory();

        static::assertEquals(new RestaurantCollection(), $factory->create());
    }
}
