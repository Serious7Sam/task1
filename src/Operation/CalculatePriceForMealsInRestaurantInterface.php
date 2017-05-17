<?php

namespace Operation;

use Entity\RestaurantInterface;

interface CalculatePriceForMealsInRestaurantInterface
{
    /**
     * @param RestaurantInterface $restaurant
     * @param string[]            $meals
     *
     * @return float
     */
    public function execute(RestaurantInterface $restaurant, array $meals): float;
}
