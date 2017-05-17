<?php

namespace Tests\Unit\Factory;

use Collection\OfferCollection;
use Factory\OfferCollectionFactory;
use PHPUnit\Framework\TestCase;

class OfferCollectionFactoryTest extends TestCase
{
    public function testCreate()
    {
        $factory = new OfferCollectionFactory();

        static::assertEquals(new OfferCollection(), $factory->create());
    }
}
