<?php

namespace App\Test\Unit\Formatter;

use App\Service\Criteria\CriteriaBuilder;
use App\Service\Criteria\FilterFactory;
use App\Service\HotelClient;
use App\Service\RoomFacade;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoomFacadeTest extends WebTestCase
{
    public function testRequest()
    {
        $criteriaBuilder = new CriteriaBuilder(new FilterFactory());
        $iterator = $this->createMock(\ArrayIterator::class);

        $roomFacade = new RoomFacade($iterator, $criteriaBuilder);
        $results = $roomFacade->findBy([]);

        $this->assertInstanceOf(ArrayCollection::class, $results);
    }
}
