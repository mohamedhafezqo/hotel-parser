<?php


namespace App\Test\Unit\Formatter;

use App\Model\Hotel;
use App\Model\Room;
use App\Service\Formatter\AdvertiserBFormatter;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class AdvertiserBFormatterTest extends TestCase
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
        return json_decode("[
    {
      \"name\": \"Hotel A\",
      \"stars\": 4,
      \"rooms\": [
        {
          \"code\": \"DBL-TWN\",
          \"name\": \"Double or Twin SUPERIOR\",
          \"net_rate\": \"143.00\",
          \"taxes\": [
            {
              \"amount\": \"10.00\",
              \"currency\": \"EUR\",
              \"type\": \"TAXESANDFEES\"
            }
          ],
          \"totalPrice\": \"153.00\"
        },
        {
          \"code\": \"HF-BD\",
          \"name\": \"HALF BOARD\",
          \"net_rate\": \"131.00\",
          \"taxes\": [
            {
              \"amount\": \"11.00\",
              \"currency\": \"EUR\",
              \"type\": \"TAXESANDFEES\"
            }
          ],
          \"totalPrice\": \"142.00\"
        },
        {
          \"code\": \"QN-RM\",
          \"name\": \"Queen Room\",
          \"net_rate\": \"140\",
          \"taxes\": [
            {
              \"amount\": \"12.00\",
              \"currency\": \"EUR\",
              \"type\": \"TAXESANDFEES\"
            },
            {
              \"amount\": \"4.00\",
              \"currency\": \"EUR\",
              \"type\": \"EXTRA_FEES\"
            }
          ],
          \"totalPrice\": \"156.00\"
        }
      ]
    },
    {
      \"name\": \"Hotel B\",
      \"stars\": 5,
      \"rooms\": [
        {
          \"code\": \"DBL-RM\",
          \"name\": \"Double Room\",
          \"net_rate\": \"152.00\",
          \"taxes\": [
            {
              \"amount\": \"15.00\",
              \"currency\": \"EUR\",
              \"type\": \"TAXESANDFEES\"
            }
          ],
          \"totalPrice\": \"167.00\"
        },
        {
          \"code\": \"HF-BOD\",
          \"name\": \"HALF BOARD\",
          \"net_rate\": \"135.00\",
          \"taxes\": [
            {
              \"amount\": \"8.00\",
              \"currency\": \"EUR\",
              \"type\": \"TAXESANDFEES\"
            },
            {
              \"amount\": \"4.00\",
              \"currency\": \"EUR\",
              \"type\": \"EXTRA_FEES\"
            }
          ],
          \"totalPrice\": \"147.00\"
        },
        {
          \"code\": \"QUN-ROM\",
          \"name\": \"Queen Room\",
          \"net_rate\": \"140.00\",
          \"taxes\": [
            {
              \"amount\": \"6.50\",
              \"currency\": \"EUR\",
              \"type\": \"EXTRA_FEES\"
            }
          ],
          \"totalPrice\": \"146.50\"
        }
      ]
    },
    {
      \"name\": \"Hotel C\",
      \"stars\": 5,
      \"rooms\": [
        {
          \"code\": \"SNG-RM\",
          \"name\": \"Single Bed\",
          \"net_rate\": \"96.00\",
          \"taxes\": [
            {
              \"amount\": \"12.00\",
              \"currency\": \"EUR\",
              \"type\": \"TAXESANDFEES\"
            }
          ],
          \"totalPrice\": \"108.00\"
        },
        {
          \"code\": \"FUBOD\",
          \"name\": \"FULL BOARD\",
          \"net_rate\": \"165.00\",
          \"taxes\": [
            {
              \"amount\": \"15.00\",
              \"currency\": \"EUR\",
              \"type\": \"TAXESANDFEES\"
            }
          ],
          \"totalPrice\": \"180.00\"
        },
        {
          \"code\": \"LUX-ROM\",
          \"name\": \"Luxury Room\",
          \"net_rate\": \"177.00\",
          \"taxes\": [
            {
              \"amount\": \"22.00\",
              \"currency\": \"EUR\",
              \"type\": \"TAXESANDFEES\"
            }
          ],
          \"totalPrice\": \"199.00\"
        }
      ]
    }
  ]", true);
    }
}
