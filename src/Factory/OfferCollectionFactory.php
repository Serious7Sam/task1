<?php

namespace Factory;

use Collection\OfferCollection;
use Collection\OfferCollectionInterface;

class OfferCollectionFactory implements OfferCollectionFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): OfferCollectionInterface
    {
        return new OfferCollection();
    }
}
