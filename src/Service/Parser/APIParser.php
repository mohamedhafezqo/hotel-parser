<?php

namespace App\Service\Parser;

use App\Service\Parser\Contract\ParserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;
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
    private $httpClient;

    /**
     * @var ArrayCollection $config
     */
    private $config;

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
     * @throws TransportExceptionInterface
     */
    public function parse()
    {
        $response = $this->httpClient->request(
            $this->config->get('method'),
            $this->config->get('url')
        );

        if ($response->getStatusCode() != Response::HTTP_OK) {
            return [];
        }

        return $response->toArray()[$this->config->get('api_json_pointer')];
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
