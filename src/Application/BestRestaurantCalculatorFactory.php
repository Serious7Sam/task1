<?php

namespace Application;

use Checker\RestaurantHasMealsChecker;
use DataProvider\Restaurant\RestaurantsByMealsDataProvider;
use DataProvider\Restaurant\RestaurantsFromFileDataProvider;
use Factory\OfferCollectionFactory;
use Factory\OfferFactory;
use Factory\RestaurantCollectionFactory;
use Factory\RestaurantFactory;
use File\FileRowDataProvider;
use File\FileRowToRestaurantConverter;
use Operation\CalculatePriceForMealsInRestaurant;

/**
 * "Dependency Injection" component
 */
class BestRestaurantCalculatorFactory
{
    /**
     * @param string $filePath
     *
     * @return BestRestaurantCalculator
     */
    public function create(string $filePath): BestRestaurantCalculator
    {
        $restaurantCollectionFactory = new RestaurantCollectionFactory();
        $rowToRestaurantConverter = new FileRowToRestaurantConverter(
            new OfferFactory(),
            new OfferCollectionFactory(),
            new RestaurantFactory()
        );
        $allRestaurantsProvider = new RestaurantsFromFileDataProvider(
            new FileRowDataProvider($filePath),
            $rowToRestaurantConverter,
            $restaurantCollectionFactory
        );
        $restaurantsProvider = new RestaurantsByMealsDataProvider(
            $allRestaurantsProvider,
            new RestaurantHasMealsChecker(),
            $restaurantCollectionFactory
        );

        return new BestRestaurantCalculator(
            $restaurantsProvider,
            new CalculatePriceForMealsInRestaurant()
        );
    }
}
