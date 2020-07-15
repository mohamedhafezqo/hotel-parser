<?php

namespace App\Service;

use App\Service\Contract\ClientInterface;
use App\Service\Parser\Contract\ParserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class HotelClient
 *
 * @package App\Service
 */
class HotelClient implements ClientInterface
{
    /**
     * @var iterable $parsers
     */
    private $parsers;

    /**
     * @var ArrayCollection $config
     */
    private $config;

    /**
     * HotelClient constructor.
     *
     * @param iterable $parsers
     * @param array    $config
     */
    public function __construct(iterable $parsers, array $config = [])
    {
        $this->parsers = $parsers;
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function request(): array
    {
        $results = [];

        /** @var  ParserInterface $parser */
        foreach ($this->parsers as $parser) {
            $results = $parser->setConfig($this->config)->parse();

            if (count($results)) {
                break;
            }
        }

        return $results;
    }

    /**
     * @param $config
     *
     * @return ClientInterface
     */
    public function setConfig($config): ClientInterface
    {
        $this->config = $config;

        return $this;
    }
}
