<?php

namespace App\Test\Unit\Criteria;

use App\Service\Advertiser\AdvertiserA;
use App\Service\Formatter\AdvertiserAFormatter;
use App\Service\HotelClient;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdvertiserATest extends WebTestCase
{
    public function testFetch()
    {
        $kernel = static::bootKernel();
        $config = $kernel->getContainer()->getParameter('advertisers');
        $client = $this->createMock(HotelClient::class);
        $formatter = $this->createMock(AdvertiserAFormatter::class);
        $formatter
            ->expects($this->once())
            ->method('format')
            ->willReturn(new ArrayCollection())
        ;

        $advertiser = new AdvertiserA($config, $client, $formatter);

        $this->assertIsArray($advertiser->fetch());
    }
}
