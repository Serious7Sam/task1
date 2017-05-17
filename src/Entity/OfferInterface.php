<?php

namespace Entity;

interface OfferInterface
{
    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param string $meal
     *
     * @return bool
     */
    public function hasMeal(string $meal): bool;

    /**
     * @return string[]
     */
    public function getMeals(): array;
}
