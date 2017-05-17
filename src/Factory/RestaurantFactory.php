<?php

namespace Factory;

use Collection\OfferCollectionInterface;
use Entity\Restaurant;
use Entity\RestaurantInterface;

class RestaurantFactory implements RestaurantFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(int $id, OfferCollectionInterface $offers): RestaurantInterface
    {
        return new Restaurant($id, $offers);
    }
}
