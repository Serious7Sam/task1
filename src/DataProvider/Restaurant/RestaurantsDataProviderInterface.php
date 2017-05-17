<?php

namespace DataProvider\Restaurant;

use Collection\RestaurantCollectionInterface;

interface RestaurantsDataProviderInterface
{
    /**
     * @return RestaurantCollectionInterface
     */
    public function get(): RestaurantCollectionInterface;
}
