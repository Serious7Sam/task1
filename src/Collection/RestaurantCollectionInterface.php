<?php

namespace Collection;

use Entity\RestaurantInterface;

interface RestaurantCollectionInterface
{
    /**
     * @param RestaurantInterface $restaurant
     *
     * @return RestaurantCollectionInterface
     */
    public function addRestaurant(RestaurantInterface $restaurant): RestaurantCollectionInterface;

    /**
     * @param int $id
     *
     * @return RestaurantCollectionInterface
     */
    public function removeRestaurant(int $id): RestaurantCollectionInterface;

    /**
     * @param int $id
     *
     * @return RestaurantInterface|null
     */
    public function get(int $id);

    /**
     * @param int $id
     *
     * @return bool
     */
    public function has(int $id): bool;

    /**
     * @return RestaurantInterface[]
     */
    public function getAll(): array;
}
