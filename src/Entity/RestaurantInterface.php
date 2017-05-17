<?php

namespace Entity;

use Collection\OfferCollectionInterface;

interface RestaurantInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return OfferCollectionInterface
     */
    public function getOffers(): OfferCollectionInterface;

    /**
     * @param OfferCollectionInterface $offers
     *
     * @return RestaurantInterface
     */
    public function addOffers(OfferCollectionInterface $offers): RestaurantInterface;
}
