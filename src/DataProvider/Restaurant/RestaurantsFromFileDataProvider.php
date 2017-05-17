<?php

namespace DataProvider\Restaurant;

use Collection\RestaurantCollectionInterface;
use Factory\RestaurantCollectionFactoryInterface;
use File\FileRowDataProviderInterface;
use File\FileRowToRestaurantConverterInterface;

class RestaurantsFromFileDataProvider implements RestaurantsDataProviderInterface
{
    /**
     * @var FileRowDataProviderInterface
     */
    private $fileRowProvider;

    /**
     * @var FileRowToRestaurantConverterInterface
     */
    private $rowToRestaurantConverter;

    /**
     * @var RestaurantCollectionFactoryInterface
     */
    private $restaurantCollectionFactory;

    /**
     * @param FileRowDataProviderInterface          $fileRowProvider
     * @param FileRowToRestaurantConverterInterface $rowToRestaurantConverter
     * @param RestaurantCollectionFactoryInterface  $restaurantCollectionFactory
     */
    public function __construct(
        FileRowDataProviderInterface $fileRowProvider,
        FileRowToRestaurantConverterInterface $rowToRestaurantConverter,
        RestaurantCollectionFactoryInterface $restaurantCollectionFactory
    ) {
        $this->fileRowProvider = $fileRowProvider;
        $this->rowToRestaurantConverter = $rowToRestaurantConverter;
        $this->restaurantCollectionFactory = $restaurantCollectionFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function get(): RestaurantCollectionInterface
    {
        $restaurants = $this->restaurantCollectionFactory->create();

        foreach ($this->fileRowProvider->get() as $row) {
            $newRestaurant = $this->rowToRestaurantConverter->convert($row);
            if (!$newRestaurant) {
                continue;
            }

            $newRestaurantId = $newRestaurant->getId();
            if (!$restaurants->has($newRestaurantId)) {
                $restaurants->addRestaurant($newRestaurant);
                continue;
            }

            $restaurants->get($newRestaurantId)->addOffers($newRestaurant->getOffers());
        }

        return $restaurants;
    }
}
