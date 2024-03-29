<?php

namespace App\Service\Criteria\Filter;

use App\Service\Criteria\Contract\FilterInterface;
use Doctrine\Common\Collections\Criteria;

/**
 * Class MaxPriceFilter
 *
 * @package App\Service\Criteria\Filter
 */
class MaxPriceFilter implements FilterInterface
{
    /**
     * @param Criteria $criteria
     * @param $value
     * @return Criteria
     */
    public function apply(Criteria $criteria, $value): Criteria
    {
        return $criteria
            ->andWhere(Criteria::expr()->lte('totalPrice', $value))
        ;
    }
}
