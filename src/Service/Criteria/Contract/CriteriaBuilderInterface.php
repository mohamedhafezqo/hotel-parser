<?php

namespace App\Service\Criteria\Contract;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface CriteriaBuilderInterface
 *
 * @package App\Service\Criteria\Contract
 */
interface CriteriaBuilderInterface
{
    /**
     * @param array $filters
     * @param ArrayCollection $results
     *
     * @return mixed
     */
    public function filter(array $filters, ArrayCollection $results): ArrayCollection;
}
