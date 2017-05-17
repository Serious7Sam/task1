<?php

namespace Factory;

use Entity\Offer;
use Entity\OfferInterface;

class OfferFactory implements OfferFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(float $price, array $meals): OfferInterface
    {
        return new Offer($price, $meals);
    }
}
