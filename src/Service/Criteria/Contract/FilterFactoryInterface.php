<?php

namespace App\Service\Criteria\Contract;

/**
 * Interface FilterFactoryInterface
 *
 * @package App\Service\Criteria\Contract
 */
interface FilterFactoryInterface
{
    /**
     * @param string $filter
     *
     * @return mixed
     */
    public function create(string $filter);
}
