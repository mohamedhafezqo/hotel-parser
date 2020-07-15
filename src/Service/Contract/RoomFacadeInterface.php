<?php

namespace App\Service\Contract;

/**
 * Interface RoomFacadeInterface
 *
 * @package App\Service\Contract
 */
interface RoomFacadeInterface
{
    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findBy(array $criteria);
}
