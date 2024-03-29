<?php

namespace App\Service\Contract;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface ClientInterface
 *
 * @package App\Service\Contract
 */
interface ClientInterface
{
    /**
     * @return array
     */
    public function request(): array;

    /**
     * @param ArrayCollection $config
     *
     * @return mixed
     */
    public function setConfig(ArrayCollection $config): ClientInterface;
}
