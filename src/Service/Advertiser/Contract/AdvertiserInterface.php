<?php

namespace App\Service\Advertiser\Contract;

/**
 * Interface AdvertiserInterface
 *
 * @package App\Service\Advertiser\Contract
 */
interface AdvertiserInterface
{
    /**
     * @return array
     */
    public function fetch(): array;
}
