<?php

namespace Entity;

use Collection\OfferCollectionInterface;

class Restaurant implements RestaurantInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var OfferCollectionInterface
     */
    private $offers;

    /**
     * @param int                      $id
     * @param OfferCollectionInterface $offers
     */
    public function __construct(int $id, OfferCollectionInterface $offers)
    {
        $this->id = $id;
        $this->offers = $offers;
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getOffers(): OfferCollectionInterface
    {
        return $this->offers;
    }

    /**
     * {@inheritDoc}
     */
    public function addOffers(OfferCollectionInterface $offers): RestaurantInterface
    {
        foreach ($offers->getAll() as $offer) {
            $this->getOffers()->addOffer($offer);
        }

        return $this;
    }
}
