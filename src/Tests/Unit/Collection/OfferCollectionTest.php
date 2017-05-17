<?php

namespace Tests\Unit\Collection;

use Collection\OfferCollection;
use Entity\Offer;
use PHPUnit\Framework\TestCase;

class OfferCollectionTest extends TestCase
{
    public function testOperationsWithOffer()
    {
        $offers = [
            new Offer(5, ['2', '4']),
            new Offer(2, ['1', '5', '6']),
        ];

        $collection = new OfferCollection();
        $collection->addOffer($offers[0])
            ->addOffer($offers[1]);

        static::assertSame($offers, $collection->getAll());
        static::assertTrue($collection->hasOffer($offers[0]));

        $collection->removeOffer($offers[0]);
        $collection->removeOffer(new Offer(2, ['1', '2']));

        static::assertFalse($collection->hasOffer($offers[0]));
    }

    public function testHasMeal()
    {
        $offers = [
            new Offer(2, ['1', '4']),
            new Offer(8, ['1', '5', '6']),
        ];

        $collection = new OfferCollection();
        $collection->addOffer($offers[0])
            ->addOffer($offers[1]);

        static::assertTrue($collection->hasMeal('4'));
        static::assertTrue($collection->hasMeal('6'));
        static::assertFalse($collection->hasMeal('10'));
    }
}
