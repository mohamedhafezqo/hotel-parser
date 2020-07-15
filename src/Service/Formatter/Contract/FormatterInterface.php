<?php

namespace App\Service\Formatter\Contract;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface FormatterInterface
 *
 * @package App\Service\Formatter\Contract
 */
interface FormatterInterface
{
    /**
     * @param array $data
     *
     * @return ArrayCollection
     */
    public function format(array $data): ArrayCollection;
}
