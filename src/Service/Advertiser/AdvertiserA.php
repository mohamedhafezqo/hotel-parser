<?php

namespace App\Service\Advertiser;

use App\Service\Advertiser\Contract\AdvertiserInterface;
use App\Service\Contract\ClientInterface;
use App\Service\Formatter\Contract\FormatterInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class AdvertiserA
 *
 * @package App\Service\Advertiser
 */
class AdvertiserA implements AdvertiserInterface
{
    /**
     * @var ArrayCollection $config
     */
    private ArrayCollection $config;

    /**
     * @var ClientInterface $hotelClient
     */
    private ClientInterface $hotelClient;

    /**
     * @var FormatterInterface $formatter
     */
    private FormatterInterface $formatter;

    /**
     * AdvertiserA constructor.
     *
     * @param array $config
     * @param ClientInterface $hotelClient
     * @param FormatterInterface $formatter
     */
    public function __construct(
        array $config,
        ClientInterface $hotelClient,
        FormatterInterface $formatter
    ) {
        $this->config = new ArrayCollection($config['advertiserA']);
        $this->hotelClient = $hotelClient;
        $this->formatter = $formatter;
    }

    /**
     * @return array
     */
    public function fetch(): array
    {
        $results = $this
            ->hotelClient
            ->setConfig($this->config)
            ->request()
        ;

        $results = $this->formatter->format($results);

        return $results->toArray();
    }
}
