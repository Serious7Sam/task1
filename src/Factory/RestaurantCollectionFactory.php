<?php

namespace Factory;

use Collection\RestaurantCollection;
use Collection\RestaurantCollectionInterface;

class RestaurantCollectionFactory implements RestaurantCollectionFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): RestaurantCollectionInterface
    {
        return new RestaurantCollection();
    }
}
