<?php

namespace App\Test\Unit\Formatter;

use App\Model\Hotel;
use App\Model\Room;
use App\Service\Formatter\AdvertiserAFormatter;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class AdvertiserAFormatterTest extends TestCase
{
    public function testFormat()
    {
        $response = $this->getMockResponse();
        $formatter = new AdvertiserAFormatter();
        $results = $formatter->format($response);

        $this->assertInstanceOf(ArrayCollection::class, $results);
        $this->assertInstanceOf(Room::class, $results->first());
        $this->assertInstanceOf(Hotel::class, $results->first()->getHotel());
        $this->assertIsArray($results->first()->getTaxes());
    }

    protected function getMockResponse()
    {
        return json_decode("[
    {
      \"name\": \"Hotel A\",
      \"stars\": 4,
      \"rooms\": [
        {
          \"code\": \"DBL-TWN\",
          \"net_price\": \"140.00\",
          \"taxes\": {
            \"amount\": \"12.00\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"152.00\"
        },
        {
          \"code\": \"HF-BD\",
          \"net_price\": \"133.00\",
          \"taxes\": {
            \"amount\": \"13.00\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"146.00\"
        },
        {
          \"code\": \"QN-RM\",
          \"net_price\": \"144\",
          \"taxes\": {
            \"amount\": \"14.00\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"158.00\"
        }
      ]
    },
    {
      \"name\": \"Hotel B\",
      \"stars\": 5,
      \"rooms\": [
        {
          \"code\": \"DBL-RM\",
          \"net_price\": \"150.00\",
          \"taxes\": {
            \"amount\": \"15.00\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"165.00\"
        },
        {
          \"code\": \"HF-BOD\",
          \"net_price\": \"130.00\",
          \"taxes\": {
            \"amount\": \"13.00\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"143.00\"
        },
        {
          \"code\": \"QUN-ROM\",
          \"net_price\": \"143.00\",
          \"taxes\": {
            \"amount\": \"11.50\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"154.50\"
        }
      ]
    },
    {
      \"name\": \"Hotel D\",
      \"stars\": 5,
      \"rooms\": [
        {
          \"code\": \"SNGRM\",
          \"net_price\": \"100.00\",
          \"taxes\": {
            \"amount\": \"15.00\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"115.00\"
        },
        {
          \"code\": \"FU-BOD\",
          \"net_price\": \"160.00\",
          \"taxes\": {
            \"amount\": \"16.00\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"176.00\"
        },
        {
          \"code\": \"POAROM\",
          \"net_price\": \"155.00\",
          \"taxes\": {
            \"amount\": \"14.00\",
            \"currency\": \"EUR\",
            \"type\": \"TAXESANDFEES\"
          },
          \"total\": \"169.00\"
        }
      ]
    }
  ]", true);
    }
}
