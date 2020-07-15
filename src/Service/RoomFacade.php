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
    /**
     * @var iterable $advertisers
     */
    private $advertisers;

    /**
     * @var CriteriaBuilderInterface $criteriaBuilder
     */
    private $criteriaBuilder;

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
    }

    /**
     * @param array $filters
     *
     * @return array|\Doctrine\Common\Collections\ArrayCollection|mixed
     */
    public function findBy(array $filters)
    {
        $results = new ArrayCollection();

        /** @var AdvertiserInterface $advertiser */
        foreach ($this->advertisers as $advertiser) {
            $results = $this->aggregate($results, $advertiser->fetch());
        }

        $results = $this->criteriaBuilder->filter($filters, $results);

        return $results;
    }

    /**
     * @param $results
     * @param $newData
     *
     * @return mixed
     */
    private function aggregate($results, $newRooms)
    {
        foreach ($newRooms as $newRoom) {
            $exists =  $results->exists(function($key, $existedRoom) use ($newRoom){

                if ($newRoom->getCode() != $existedRoom->getCode()) {
                    return false;
                }

                $lessPrice = $this->getLessPrice($existedRoom, $newRoom);
                $existedRoom->setTotalPrice($lessPrice);

                return true;
            });

            if (!$exists) {
                $results->add($newRoom);
            }
        }

        return $results;
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
