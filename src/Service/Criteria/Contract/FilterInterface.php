<?php

namespace App\Service\Criteria\Contract;

use Doctrine\Common\Collections\Criteria;

/**
 * Interface FilterInterface
 *
 * @package App\Service\Criteria\Contract
 */
interface FilterInterface
{
    /**
     * @param Criteria $criteria
     * @param $value
     * @return Criteria
     */
    public function apply(Criteria $criteria, $value): Criteria;
}
