<?php

namespace Tests\Unit\Entity;

use Collection\OfferCollection;
use Entity\Offer;
use Entity\Restaurant;
use PHPUnit\Framework\TestCase;

class RestaurantTest extends TestCase
{
    public function testOperations()
    {
        $offers = [
            new Offer(1, ['1']),
            new Offer(2, ['2']),
        ];

        $id = 1;
        $offerCollection = (new OfferCollection())->addOffer($offers[0]);
        $restaurant = new Restaurant($id, $offerCollection);

        static::assertSame($id, $restaurant->getId());
        static::assertSame($offerCollection, $restaurant->getOffers());

        $restaurant->addOffers((new OfferCollection())->addOffer($offers[1]));

        static::assertEquals(
            (new OfferCollection())->addOffer($offers[0])->addOffer($offers[1]),
            $restaurant->getOffers()
        );
    }
}
