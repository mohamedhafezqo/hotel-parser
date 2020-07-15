<?php

namespace App\Service\Criteria\Filter;

use App\Service\Criteria\Contract\FilterInterface;
use Doctrine\Common\Collections\Criteria;

/**
 * Class CodeFilter
 *
 * @package App\Service\Criteria\Filter
 */
class CodeFilter implements FilterInterface
{
    /**
     * @param Criteria $criteria
     * @param $value
     * @return Criteria
     */
    public function apply(Criteria $criteria, $value): Criteria
    {
        return $criteria
            ->andWhere(Criteria::expr()->eq('code', strtoupper($value)))
        ;
    }
}
