<?php

namespace App\Service\Parser;

use App\Service\Parser\Contract\ParserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class Parser
 *
 * @package App\Service\Parser
 */
class APIParser implements ParserInterface
{
    /**
     * @var HttpClientInterface $httpClient
     */
    private HttpClientInterface $httpClient;

    /**
     * @var ArrayCollection $config
     */
    private ArrayCollection $config;

    /**
     * Parser constructor.
     *
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function parse()
    {
        try {
            $response = $this->httpClient->request(
                $this->config->get('method'),
                $this->config->get('url'),
                [
                    'timeout' => $this->config->get('time_out_limit')
                ]
            );

            return $response->toArray()[$this->config->get('api_json_pointer')];

        } catch (\Throwable $exception) {
            // Log the error
            // $exception->getMessage();
            return [];
        }
    }

    /**
     * @param ArrayCollection $config
     *
     * @return $this
     */
    public function setConfig(ArrayCollection $config)
    {
        $this->config = $config;

        return $this;
    }
}
