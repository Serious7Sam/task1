<?php

namespace Tests\Unit\DataProvider\Restaurant;

use Collection\OfferCollection;
use Collection\RestaurantCollection;
use DataProvider\Restaurant\RestaurantsFromFileDataProvider;
use Entity\Offer;
use Entity\Restaurant;
use Factory\RestaurantCollectionFactoryInterface;
use File\FileRowDataProviderInterface;
use File\FileRowToRestaurantConverterInterface;
use PHPUnit\Framework\TestCase;

class RestaurantsFromFileDataProviderTest extends TestCase
{
    /**
     * @var FileRowDataProviderInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $fileRowProvider;

    /**
     * @var FileRowToRestaurantConverterInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $rowToRestaurantConverter;

    /**
     * @var RestaurantCollectionFactoryInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $restaurantCollectionFactory;

    /**
     * @var RestaurantsFromFileDataProvider
     */
    private $provider;

    protected function setUp()
    {
        $this->fileRowProvider = $this->createMock(FileRowDataProviderInterface::class);
        $this->rowToRestaurantConverter = $this->createMock(FileRowToRestaurantConverterInterface::class);
        $this->restaurantCollectionFactory = $this->createMock(RestaurantCollectionFactoryInterface::class);

        $this->provider = new RestaurantsFromFileDataProvider(
            $this->fileRowProvider,
            $this->rowToRestaurantConverter,
            $this->restaurantCollectionFactory
        );
    }

    public function testGet()
    {
        $offers = [
            (new OfferCollection())->addOffer(new Offer(2, ['1'])),
            (new OfferCollection())->addOffer(new Offer(3, ['1', '3'])),
            (new OfferCollection())->addOffer(new Offer(5, ['4', '8']))
        ];

        $restaurants = [
            new Restaurant(1, $offers[0]),
            new Restaurant(1, $offers[1]),
            new Restaurant(2, $offers[2]),
        ];

        $this->restaurantCollectionFactory->expects(static::once())
            ->method('create')
            ->willReturn(new RestaurantCollection());

        $row = [['1'], ['2'], ['3'], ['4']];
        $this->fileRowProvider->expects(static::once())
            ->method('get')
            ->willReturn($row);

        $this->rowToRestaurantConverter->expects(static::any())
            ->method('convert')
            ->willReturnMap([
                [$row[0], $restaurants[0]],
                [$row[1], $restaurants[1]],
                [$row[2], null],
                [$row[3], $restaurants[2]],
            ]);

        $expected = new RestaurantCollection();
        $expected->addRestaurant($restaurants[0]->addOffers($restaurants[1]->getOffers()));
        $expected->addRestaurant($restaurants[2]);

        static::assertEquals($expected, $this->provider->get());
    }
}
