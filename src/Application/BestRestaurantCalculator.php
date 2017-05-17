<?php

namespace Application;

use DataProvider\Restaurant\RestaurantsByMealsDataProviderInterface;
use Operation\CalculatePriceForMealsInRestaurantInterface;

class BestRestaurantCalculator
{
    /**
     * @var RestaurantsByMealsDataProviderInterface
     */
    private $restaurantsProvider;

    /**
     * @var CalculatePriceForMealsInRestaurantInterface
     */
    private $restaurantPriceCalculator;

    /**
     * @param RestaurantsByMealsDataProviderInterface     $restaurantsProvider
     * @param CalculatePriceForMealsInRestaurantInterface $restaurantPriceCalculator
     */
    public function __construct(
        RestaurantsByMealsDataProviderInterface $restaurantsProvider,
        CalculatePriceForMealsInRestaurantInterface $restaurantPriceCalculator
    ) {
        $this->restaurantsProvider = $restaurantsProvider;
        $this->restaurantPriceCalculator = $restaurantPriceCalculator;
    }

    /**
     * @param string[] $meals
     *
     * @return BestRestaurantCalculatorResult|null
     */
    public function getResult(array $meals)
    {
        $minPrice = PHP_INT_MAX;
        $bestRestaurantId = null;

        $restaurants = $this->restaurantsProvider->get($meals);
        foreach ($restaurants->getAll() as $restaurant) {
            $price = $this->restaurantPriceCalculator->execute($restaurant, $meals);

            if ($price < $minPrice) {
                $minPrice = $price;
                $bestRestaurantId = $restaurant->getId();
            }
        }

        if (!$bestRestaurantId) {
            return null;
        }

        return new BestRestaurantCalculatorResult($bestRestaurantId, $minPrice);
    }
}
