<?php

namespace File;

use Factory\OfferCollectionFactoryInterface;
use Factory\OfferFactoryInterface;
use Factory\RestaurantFactoryInterface;

class FileRowToRestaurantConverter implements FileRowToRestaurantConverterInterface
{
    /**
     * @var OfferFactoryInterface
     */
    private $offerFactory;

    /**
     * @var OfferCollectionFactoryInterface
     */
    private $offerCollectionFactory;

    /**
     * @var RestaurantFactoryInterface
     */
    private $restaurantFactory;

    /**
     * @param OfferFactoryInterface           $offerFactory
     * @param OfferCollectionFactoryInterface $offerCollectionFactory
     * @param RestaurantFactoryInterface      $restaurantFactory
     */
    public function __construct(
        OfferFactoryInterface $offerFactory,
        OfferCollectionFactoryInterface $offerCollectionFactory,
        RestaurantFactoryInterface $restaurantFactory
    ) {
        $this->offerFactory = $offerFactory;
        $this->offerCollectionFactory = $offerCollectionFactory;
        $this->restaurantFactory = $restaurantFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function convert(array $row)
    {
        $columnCount = count($row);
        if ($columnCount < 3) {
            return null;
        }

        $restaurantId = (int) $row[0];
        $price = (float) $row[1];

        $meals = [];
        for ($i = 2; $i < $columnCount; $i++) {
            $meals[] = trim($row[$i]);
        }

        $offer = $this->offerFactory->create($price, $meals);

        $offers = $this->offerCollectionFactory->create();
        $offers->addOffer($offer);

        return $this->restaurantFactory->create($restaurantId, $offers);
    }
}
