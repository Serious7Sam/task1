<?php

namespace Factory;

use Entity\OfferInterface;

interface OfferFactoryInterface
{
    /**
     * @param float $price
     * @param array $meals
     *
     * @return OfferInterface
     */
    public function create(float $price, array $meals): OfferInterface;
}
