<?php

namespace Collection;

use Entity\OfferInterface;

class OfferCollection implements OfferCollectionInterface
{
    /**
     * @var OfferInterface[]
     */
    private $offers = [];

    /**
     * @param array $offers
     */
    public function __construct(array $offers = [])
    {
        $this->offers = $offers;
    }

    /**
     * {@inheritDoc}
     */
    public function addOffer(OfferInterface $offer): OfferCollectionInterface
    {
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeOffer(OfferInterface $offer): OfferCollectionInterface
    {
        if ($this->hasOffer($offer)) {
            array_splice($this->offers, array_search($offer, $this->offers, true), 1);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasOffer(OfferInterface $offer): bool
    {
        return in_array($offer, $this->offers, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(): array
    {
        return $this->offers;
    }

    /**
     * {@inheritDoc}
     */
    public function hasMeal(string $meal): bool
    {
        foreach ($this->getAll() as $offer) {
            if ($offer->hasMeal($meal)) {
                return true;
            }
        }

        return false;
    }
}
