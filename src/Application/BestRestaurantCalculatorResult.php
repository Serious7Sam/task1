<?php

namespace Application;

class BestRestaurantCalculatorResult
{
    /**
     * @var int
     */
    private $restaurantId;

    /**
     * @var float
     */
    private $totalPrice;

    /**
     * @param int   $restaurantId
     * @param float $totalPrice
     */
    public function __construct(int $restaurantId, float $totalPrice)
    {
        $this->restaurantId = $restaurantId;
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return int
     */
    public function getRestaurantId(): int
    {
        return $this->restaurantId;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
}
