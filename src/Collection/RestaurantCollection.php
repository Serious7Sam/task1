<?php

namespace Collection;

use Entity\RestaurantInterface;

class RestaurantCollection implements RestaurantCollectionInterface
{
    /**
     * @var array<id => RestaurantInterface>
     */
    private $restaurants = [];

    /**
     * {@inheritDoc}
     */
    public function addRestaurant(RestaurantInterface $restaurant): RestaurantCollectionInterface
    {
        $this->restaurants[$restaurant->getId()] = $restaurant;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeRestaurant(int $id): RestaurantCollectionInterface
    {
        unset($this->restaurants[$id]);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(int $id)
    {
        if (!$this->has($id)) {
            return null;
        }

        return $this->restaurants[$id];
    }

    /**
     * {@inheritDoc}
     */
    public function has(int $id): bool
    {
        return array_key_exists($id, $this->restaurants);
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(): array
    {
        return $this->restaurants;
    }
}
