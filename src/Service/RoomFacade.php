<?php

namespace App\Service;

use App\Model\Room;
use App\Service\Contract\RoomFacadeInterface;
use App\Service\Advertiser\Contract\AdvertiserInterface;
use App\Service\Criteria\Contract\CriteriaBuilderInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class RoomFacade
 *
 * @package App\Service
 */
class RoomFacade implements RoomFacadeInterface
{
    private ArrayCollection $results;

    private iterable $advertisers;

    private CriteriaBuilderInterface $criteriaBuilder;

    /**
     * RoomFacade constructor.
     *
     * @param iterable $advertisers
     * @param CriteriaBuilderInterface $criteriaBuilder
     */
    public function __construct(iterable $advertisers, CriteriaBuilderInterface $criteriaBuilder)
    {
        $this->advertisers = $advertisers;
        $this->criteriaBuilder = $criteriaBuilder;
        $this->results = new ArrayCollection();
    }

    /**
     * @param array $filters
     *
     * @return array|\Doctrine\Common\Collections\ArrayCollection|mixed
     */
    public function findBy(array $filters)
    {
        /** @var AdvertiserInterface $advertiser */
        foreach ($this->advertisers as $advertiser) {
            $this->aggregate($advertiser->fetch());
        }

        return $this->criteriaBuilder->filter($filters, $this->results);
    }

    /**
     * @param $results
     * @param $newData
     *
     * @return mixed
     */
    private function aggregate($newRooms): void
    {
        foreach ($newRooms as $newRoom) {
            $exists =  $this->isExist($newRoom);

            if (!$exists) {
                $this->results->add($newRoom);
            }
        }
    }

    private function isExist($newRoom): bool
    {
        return $this->results->exists(function($key, $existedRoom) use ($newRoom){

            if ($newRoom->getCode() != $existedRoom->getCode()) {
                return false;
            }

            $lessPrice = $this->getLessPrice($existedRoom, $newRoom);
            $existedRoom->setTotalPrice($lessPrice);

            return true;
        });
    }

    /**
     * @param \App\Model\Room $existRoom
     * @param \App\Model\Room $newRoom
     *
     * @return string
     */
    private function getLessPrice(Room $existRoom, Room $newRoom)
    {
        return $existRoom->getTotalPrice() < $newRoom->getTotalPrice()
            ? $existRoom->getTotalPrice()
            : $newRoom->getTotalPrice()
        ;
    }
}
