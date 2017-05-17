<?php

namespace Operation;

use Entity\OfferInterface;
use Entity\RestaurantInterface;

class CalculatePriceForMealsInRestaurant implements CalculatePriceForMealsInRestaurantInterface
{
    public function execute(RestaurantInterface $restaurant, array $meals): float
    {
        $offers = $this->getSortedByPriceOffers($restaurant);

        $price = 0;
        foreach ($offers as $offer) {
            if (empty($meals)) {
                break;
            }

            foreach ($meals as $meal) {
                if ($offer->hasMeal($meal)) {
                    unset($meals[array_search($meal, $meals, true)]);
                }
            }
            $price += $offer->getPrice();
        }

        return $price;
    }

    /**
     * @param RestaurantInterface $restaurant
     *
     * @return OfferInterface[]
     */
    private function getSortedByPriceOffers(RestaurantInterface $restaurant): array
    {
        $offers = $restaurant->getOffers()->getAll();
        usort($offers, function(OfferInterface $a, OfferInterface $b) {
            return $a->getPrice() > $b->getPrice();
        });

        return $offers;
    }
}
