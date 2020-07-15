<?php


namespace App\Test\Unit\Formatter;

use App\Service\HotelClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelClientTest extends WebTestCase
{
    public function testRequest()
    {
        $config = $this->getConfigMock();
        $iterator = $this->createMock(\ArrayIterator::class);

        $hotelClient = new HotelClient($iterator, $config['advertiserA']);
        $results = $hotelClient->request();

        $this->assertIsArray($results);
    }

    protected function getConfigMock()
    {
        $kernel = static::bootKernel();

        return $kernel->getContainer()->getParameter('advertisers');
    }
}
