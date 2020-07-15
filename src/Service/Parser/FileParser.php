<?php

namespace App\Service\Parser;

use App\Model\Transaction;
use App\Service\Parser\Contract\ParserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use JsonMachine\JsonMachine;

/**
 * Class FileParser
 *
 * @package App\Service\Parser
 */
class FileParser implements ParserInterface
{
    /**
     * @var ArrayCollection $config
     */
    private $config;

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

    /**
     * @return array|mixed
     * @throws \Exception
     */
    public function parse()
    {
        $results = [];
        $iteratorResults = $this->streamFileContent($this->config->get('file'));

        foreach ($iteratorResults as $iteratorResult) {
            $results [] = $iteratorResult;

            if (count($results) >= $this->config->get('file_stream_limit')) {
                break;
            }
        }

        return $results;
    }

    /**
     * @param string $filePath
     *
     * @return \JsonMachine\JsonMachine
     * @throws \Exception
     */
    private function streamFileContent(string $filePath)
    {
        $stream = $this->openFile($filePath);

        return JsonMachine::fromStream($stream, $this->config->get('file_json_pointer'));
    }

    /**
     * @param string $filePath
     *
     * @return false|resource
     * @throws \Exception
     */
    private function openFile(string $filePath)
    {
        $stream = fopen($filePath, 'r');

        if (false === $stream) {
            throw new \Exception('Unable to open file for read: ' . $filePath);
        }

        return $stream;
    }
}
