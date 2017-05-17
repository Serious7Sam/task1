<?php

namespace Collection;

use Entity\OfferInterface;

interface OfferCollectionInterface
{
    /**
     * @param OfferInterface $offer
     *
     * @return OfferCollectionInterface
     */
    public function addOffer(OfferInterface $offer): OfferCollectionInterface;

    /**
     * @param OfferInterface $offer
     *
     * @return OfferCollectionInterface
     */
    public function removeOffer(OfferInterface $offer): OfferCollectionInterface;

    /**
     * @param OfferInterface $offer
     *
     * @return bool
     */
    public function hasOffer(OfferInterface $offer): bool;

    /**
     * @return OfferInterface[]
     */
    public function getAll(): array;

    /**
     * @param string $meal
     *
     * @return bool
     */
    public function hasMeal(string $meal): bool;
}
