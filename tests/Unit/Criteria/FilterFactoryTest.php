<?php


namespace App\Test\Unit\Criteria;

use App\Service\Criteria\Contract\FilterInterface;
use App\Service\Criteria\FilterFactory;
use PHPUnit\Framework\TestCase;

class FilterFactoryTest extends TestCase
{
    public function testCreateSortFilter()
    {
        $filterName = 'sortByPrice';

        $filterFactory = new FilterFactory();
        $filter = $filterFactory->create($filterName);

        $this->assertInstanceOf(FilterInterface::class, $filter);
    }

    public function testCreateCodeFilter()
    {
        $filterName = 'code';

        $filterFactory = new FilterFactory();
        $filter = $filterFactory->create($filterName);

        $this->assertInstanceOf(FilterInterface::class, $filter);
    }

    public function testCreateMaxPriceFilter()
    {
        $filterName = 'maxPrice';

        $filterFactory = new FilterFactory();
        $filter = $filterFactory->create($filterName);

        $this->assertInstanceOf(FilterInterface::class, $filter);
    }

    public function testCreateMinPriceFilter()
    {
        $filterName = 'minPrice';

        $filterFactory = new FilterFactory();
        $filter = $filterFactory->create($filterName);

        $this->assertInstanceOf(FilterInterface::class, $filter);
    }
}
