<?php

namespace App\Service\Criteria;

use App\Service\Criteria\Contract\FilterFactoryInterface;

/**
 * Class FilterFactory
 *
 * @package App\Service\CriteriaBuilder
 */
class FilterFactory implements FilterFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(string $filterName)
    {
        $className = ucfirst($filterName).'Filter';
        $filter = 'App\Service\Criteria\Filter\\'.$className;

        if (class_exists($filter)) {
            return new $filter();
        }
    }
}
