<?php

namespace App\Test\Unit\Criteria;

use App\Service\Parser\APIParser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class APIParserTest extends WebTestCase
{
    public function testParse()
    {
        $kernel = static::bootKernel();
        $config = $kernel->getContainer()->getParameter('advertisers');
        $config = new ArrayCollection($config['advertiserA']);

        $expectedContent = file_get_contents($config->get('file'));

        $expectedResponse = new MockResponse($expectedContent);
        $client = new MockHttpClient($expectedResponse);

        $parser = new APIParser($client);
        $actualResponse = $parser->setConfig($config)->parse();

        $expectedRoomCode = $this->getExpectedContentRoomCodeValue($expectedContent, $config);

        $this->assertEquals($expectedRoomCode, $actualResponse[0]['rooms'][0]['code']);
    }

    protected function getExpectedContentRoomCodeValue($expectedContent, ArrayCollection $config)
    {
        $expectedRoomCode = json_decode($expectedContent, true);
        $expectedRoomCode = $expectedRoomCode[$config->get('api_json_pointer')][0];
        $expectedRoomCode = $expectedRoomCode['rooms'][0]['code'];

        return $expectedRoomCode;
    }
}
