<?php

namespace Factory;

use Collection\RestaurantCollectionInterface;

interface RestaurantCollectionFactoryInterface
{
    /**
     * @return RestaurantCollectionInterface
     */
    public function create(): RestaurantCollectionInterface;
}
