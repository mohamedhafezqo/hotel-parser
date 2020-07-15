<?php


namespace App\Test\Unit\Criteria;

use App\Model\Room;
use App\Service\Criteria\CriteriaBuilder;
use App\Service\Criteria\FilterFactory;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class CriteriaBuilderTest extends TestCase
{
    public function testFilterReturn()
    {
        $filterFactory = new FilterFactory();
        $criteriaBuilder = new CriteriaBuilder($filterFactory);
        $roomsCollection = $this->getMockRoomsCollections();
        $results = $criteriaBuilder->filter([], $roomsCollection);

        $this->assertInstanceOf(ArrayCollection::class, $results);
    }

    public function testFilterAscendingSort()
    {
        $filters = [
            'sortByPrice' => 'asc'
        ];

        $filterFactory = new FilterFactory();
        $criteriaBuilder = new CriteriaBuilder($filterFactory);
        $roomsCollection = $this->getMockRoomsCollections();
        $results = $criteriaBuilder->filter($filters, $roomsCollection);

        $this->assertEquals("120", $results->first()->getTotalPrice());
    }

    public function testFilterDescendingSort()
    {
        $filters = [
            'sortByPrice' => 'desc'
        ];

        $filterFactory = new FilterFactory();
        $criteriaBuilder = new CriteriaBuilder($filterFactory);
        $roomsCollection = $this->getMockRoomsCollections();
        $results = $criteriaBuilder->filter($filters, $roomsCollection);

        $this->assertEquals("130", $results->first()->getTotalPrice());
    }

    public function testFilterByMaxPrice()
    {
        $filters = [
            'maxPrice' => '120'
        ];

        $filterFactory = new FilterFactory();
        $criteriaBuilder = new CriteriaBuilder($filterFactory);
        $roomsCollection = $this->getMockRoomsCollections();
        $results = $criteriaBuilder->filter($filters, $roomsCollection);

        $this->assertCount(1, $results);
    }

    public function testFilterByMinPrice()
    {
        $filters = [
            'minPrice' => '130'
        ];

        $filterFactory = new FilterFactory();
        $criteriaBuilder = new CriteriaBuilder($filterFactory);
        $roomsCollection = $this->getMockRoomsCollections();
        $results = $criteriaBuilder->filter($filters, $roomsCollection);

        $this->assertCount(1, $results);
    }


    public function testFilterByCode()
    {
        $filters = [
            'code' => 'AH-OJ'
        ];

        $filterFactory = new FilterFactory();
        $criteriaBuilder = new CriteriaBuilder($filterFactory);
        $roomsCollection = $this->getMockRoomsCollections();
        $results = $criteriaBuilder->filter($filters, $roomsCollection);

        $this->assertCount(1, $results);
        $this->assertEquals('AH-OJ', $results->first()->getCode());
    }

    protected function getMockRoomsCollections()
    {
        $roomsCollection = new ArrayCollection();
        $roomOne = new Room();
        $roomOne
            ->setName("Mao")
            ->setCode("ARH-PO")
            ->setTotalPrice('130')
        ;
        $roomsCollection->add($roomOne);

        $roomTwo = new Room();
        $roomTwo
            ->setName("IMY")
            ->setCode("AH-OJ")
            ->setTotalPrice('120')
        ;
        $roomsCollection->add($roomTwo);

        return $roomsCollection;
    }
}
