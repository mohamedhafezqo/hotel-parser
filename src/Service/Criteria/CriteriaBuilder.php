<?php

namespace App\Service\Criteria;

use App\Service\Criteria\Contract\CriteriaBuilderInterface;
use App\Service\Criteria\Contract\FilterFactoryInterface;
use App\Service\Criteria\Contract\FilterInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * Class CriteriaBuilder
 *
 * @package App\Service\CriteriaBuilder
 */
class CriteriaBuilder implements CriteriaBuilderInterface
{
    /**
     * @var FilterFactoryInterface $filterFactory
     */
    private $filterFactory;

    /**
     * CriteriaBuilder constructor.
     *
     * @param FilterFactoryInterface $filterFactory
     */
    public function __construct(FilterFactoryInterface $filterFactory)
    {
        $this->filterFactory = $filterFactory;
    }

    /**
     * @param array $filters
     * @param ArrayCollection $results
     *
     * @return ArrayCollection
     */
    public function filter(array $filters, ArrayCollection $results): ArrayCollection
    {
        $criteria = $this->build($filters);

        return $results->matching($criteria);
    }

    /**
     * @param array $filters
     *
     * @return Criteria
     */
    protected function build(array $filters): Criteria
    {
        $criteria = Criteria::create();
        foreach ($filters as $filterName => $value) {
            $filter = $this->filterFactory->create($filterName);

            if ($filter instanceof FilterInterface) {
                $criteria = $filter->apply($criteria, $value);
            }
        }

        return $criteria;
    }
}
