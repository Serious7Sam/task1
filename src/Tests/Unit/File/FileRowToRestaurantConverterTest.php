<?php

namespace Tests\Unit\File;

use Collection\OfferCollection;
use Entity\Offer;
use Entity\Restaurant;
use Factory\OfferCollectionFactoryInterface;
use Factory\OfferFactoryInterface;
use Factory\RestaurantFactoryInterface;
use File\FileRowToRestaurantConverter;
use PHPUnit\Framework\TestCase;

class FileRowToRestaurantConverterTest extends TestCase
{
    /**
     * @var OfferFactoryInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $offerFactory;

    /**
     * @var OfferCollectionFactoryInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $offerCollectionFactory;

    /**
     * @var RestaurantFactoryInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $restaurantFactory;

    /**
     * @var FileRowToRestaurantConverter
     */
    private $converter;

    protected function setUp()
    {
        $this->offerFactory = $this->createMock(OfferFactoryInterface::class);
        $this->offerCollectionFactory = $this->createMock(OfferCollectionFactoryInterface::class);
        $this->restaurantFactory = $this->createMock(RestaurantFactoryInterface::class);

        $this->converter = new FileRowToRestaurantConverter(
            $this->offerFactory,
            $this->offerCollectionFactory,
            $this->restaurantFactory
        );
    }

    public function testConvertWrongRowCount()
    {
        static::assertNull($this->converter->convert(['1', '2']));
    }

    public function testConvert()
    {
        $id = '1';
        $price = '5.5';
        $meals = ['meal1', 'meal2'];

        $row = [$id, $price, $meals[0], $meals[1]];

        $offer = new Offer($price, $meals);
        $offers = new OfferCollection();

        $this->offerFactory->expects(static::once())
            ->method('create')
            ->with($price, $meals)
            ->willReturn($offer);

        $this->offerCollectionFactory->expects(static::once())
            ->method('create')
            ->willReturn($offers);

        $offers->addOffer($offer);
        $restaurant = new Restaurant($id, $offers);

        $this->restaurantFactory->expects(static::once())
            ->method('create')
            ->with($id, $offers)
            ->willReturn($restaurant);

        static::assertSame($restaurant, $this->converter->convert($row));
    }
}
