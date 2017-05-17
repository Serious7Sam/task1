<?php

namespace Factory;

use Collection\OfferCollectionInterface;
use Entity\RestaurantInterface;

interface RestaurantFactoryInterface
{
    /**
     * @param int                      $id
     * @param OfferCollectionInterface $offers
     *
     * @return RestaurantInterface
     */
    public function create(int $id, OfferCollectionInterface $offers): RestaurantInterface;
}
