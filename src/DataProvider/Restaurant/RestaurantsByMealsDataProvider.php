<?php

namespace DataProvider\Restaurant;

use Checker\RestaurantMealsCheckerInterface;
use Collection\RestaurantCollectionInterface;
use Factory\RestaurantCollectionFactoryInterface;

class RestaurantsByMealsDataProvider implements RestaurantsByMealsDataProviderInterface
{
    /**
     * @var RestaurantsDataProviderInterface
     */
    private $restaurantProvider;

    /**
     * @var RestaurantMealsCheckerInterface
     */
    private $restaurantHasMealsChecker;

    /**
     * @var RestaurantCollectionFactoryInterface
     */
    private $restaurantCollectionFactory;

    /**
     * @param RestaurantsDataProviderInterface     $restaurantProvider
     * @param RestaurantMealsCheckerInterface      $restaurantHasMealsChecker
     * @param RestaurantCollectionFactoryInterface $restaurantCollectionFactory
     */
    public function __construct(
        RestaurantsDataProviderInterface $restaurantProvider,
        RestaurantMealsCheckerInterface $restaurantHasMealsChecker,
        RestaurantCollectionFactoryInterface $restaurantCollectionFactory
    ) {
        $this->restaurantProvider = $restaurantProvider;
        $this->restaurantHasMealsChecker = $restaurantHasMealsChecker;
        $this->restaurantCollectionFactory = $restaurantCollectionFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function get(array $meals): RestaurantCollectionInterface
    {
        $restaurants = $this->restaurantProvider->get();

        $result = $this->restaurantCollectionFactory->create();
        foreach ($restaurants->getAll() as $restaurant) {
            if ($this->restaurantHasMealsChecker->check($restaurant, $meals)) {
                $result->addRestaurant($restaurant);
            }
        }

        return $result;
    }
}
