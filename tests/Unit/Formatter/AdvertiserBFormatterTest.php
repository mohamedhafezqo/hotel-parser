<?php


namespace App\Test\Unit\Formatter;

use App\Model\Hotel;
use App\Model\Room;
use App\Service\Formatter\AdvertiserBFormatter;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdvertiserBFormatterTest extends WebTestCase
{
    public function testFormat()
    {
        $response = $this->getMockResponse();
        $formatter = new AdvertiserBFormatter();
        $results = $formatter->format($response);

        $this->assertInstanceOf(ArrayCollection::class, $results);
        $this->assertInstanceOf(Room::class, $results->first());
        $this->assertInstanceOf(Hotel::class, $results->first()->getHotel());
        $this->assertIsArray($results->first()->getTaxes());
    }

    protected function getMockResponse()
    {
        $kernel = static::bootKernel();
        $config = $kernel->getContainer()->getParameter('advertisers');
        $config = new ArrayCollection($config['advertiserB']);

        $response = json_decode(file_get_contents($config->get('file')), true);

        return $response['hotels'];
    }
}
