<?php

namespace Checker;

use Entity\RestaurantInterface;

class RestaurantHasMealsChecker implements RestaurantMealsCheckerInterface
{
    /**
     * {@inheritDoc}
     */
    public function check(RestaurantInterface $restaurant, array $meals): bool
    {
        foreach ($meals as $meal) {
            if (!$restaurant->getOffers()->hasMeal($meal)) {
                return false;
            }
        }

        return true;
    }
}
