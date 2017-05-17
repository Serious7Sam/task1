<?php

namespace DataProvider\Restaurant;

use Collection\RestaurantCollectionInterface;

interface RestaurantsByMealsDataProviderInterface
{
    /**
     * @param string[] $meals
     *
     * @return RestaurantCollectionInterface
     */
    public function get(array $meals): RestaurantCollectionInterface;
}
