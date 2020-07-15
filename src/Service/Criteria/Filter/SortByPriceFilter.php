<?php

namespace App\Service\Criteria\Filter;

use App\Service\Criteria\Contract\FilterInterface;
use Doctrine\Common\Collections\Criteria;

/**
 * Class SortFilter
 *
 * @package App\Service\CriteriaBuilder\Filter
 */
class SortByPriceFilter implements FilterInterface
{
    /**
     * @param Criteria $criteria
     * @param $value
     * @return Criteria
     */
    public function apply(Criteria $criteria, $value): Criteria
    {
        $value = strtoupper((string)$value);
        $value = in_array($value, [Criteria::ASC, Criteria::DESC]) ? $value : Criteria::ASC;

        return $criteria->orderBy([
            'totalPrice' =>  $value
        ]);
    }
}
