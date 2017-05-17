<?php

namespace Factory;

use Collection\OfferCollectionInterface;

interface OfferCollectionFactoryInterface
{
    /**
     * @return OfferCollectionInterface
     */
    public function create(): OfferCollectionInterface;
}
