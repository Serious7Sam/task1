<?php

namespace Checker;

use Entity\RestaurantInterface;

interface RestaurantMealsCheckerInterface
{
    /**
     * @param RestaurantInterface $restaurant
     * @param array               $meals
     *
     * @return bool
     */
    public function check(RestaurantInterface $restaurant, array $meals): bool;
}
