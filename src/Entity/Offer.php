<?php

namespace Entity;

class Offer implements OfferInterface
{
    /**
     * @var float
     */
    private $price;

    /**
     * @var string[]
     */
    private $meals;

    /**
     * @param float    $price
     * @param string[] $meals
     */
    public function __construct(float $price, array $meals)
    {
        $this->price = $price;
        $this->meals = $meals;
    }

    /**
     * {@inheritDoc}
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * {@inheritDoc}
     */
    public function hasMeal(string $meal): bool
    {
        return in_array($meal, $this->meals, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getMeals(): array
    {
        return $this->meals;
    }
}
