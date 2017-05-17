<?php

namespace Tests\Unit\DataProvider\Restaurant;

use Checker\RestaurantMealsCheckerInterface;
use Collection\OfferCollection;
use Collection\RestaurantCollection;
use DataProvider\Restaurant\RestaurantsByMealsDataProvider;
use DataProvider\Restaurant\RestaurantsDataProviderInterface;
use Entity\Restaurant;
use Factory\RestaurantCollectionFactoryInterface;
use PHPUnit\Framework\TestCase;

class RestaurantsByMealsDataProviderTest extends TestCase
{
    /**
     * @var RestaurantsDataProviderInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $restaurantProvider;

    /**
     * @var RestaurantMealsCheckerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $restaurantHasMealsChecker;

    /**
     * @var RestaurantCollectionFactoryInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $restaurantCollectionFactory;

    /**
     * @var RestaurantsByMealsDataProvider
     */
    private $provider;

    protected function setUp()
    {
        $this->restaurantProvider = $this->createMock(RestaurantsDataProviderInterface::class);
        $this->restaurantHasMealsChecker = $this->createMock(RestaurantMealsCheckerInterface::class);
        $this->restaurantCollectionFactory = $this->createMock(RestaurantCollectionFactoryInterface::class);

        $this->provider = new RestaurantsByMealsDataProvider(
            $this->restaurantProvider,
            $this->restaurantHasMealsChecker,
            $this->restaurantCollectionFactory
        );
    }

    public function testGet()
    {
        $restaurants = [
            1 => new Restaurant(1, new OfferCollection()),
            2 => new Restaurant(2, new OfferCollection()),
        ];
        $restaurantCollection = new RestaurantCollection();
        $restaurantCollection->addRestaurant($restaurants[1])
            ->addRestaurant($restaurants[2]);

        $this->restaurantProvider->expects(static::once())
            ->method('get')
            ->willReturn($restaurantCollection);

        $this->restaurantCollectionFactory->expects(static::once())
            ->method('create')
            ->willReturn(new RestaurantCollection());

        $meals = ['1', '2'];
        $this->restaurantHasMealsChecker->expects(static::any())
            ->method('check')
            ->willReturnMap([
                [$restaurants[1], $meals, true],
                [$restaurants[2], $meals, false],
            ]);

        static::assertEquals(
            (new RestaurantCollection())->addRestaurant($restaurants[1]),
            $this->provider->get($meals)
        );
    }
}
