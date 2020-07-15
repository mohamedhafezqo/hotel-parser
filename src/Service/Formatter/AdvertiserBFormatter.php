<?php

namespace App\Service\Formatter;

use App\Model\Hotel;
use App\Model\Room;
use App\Model\Tax;
use App\Service\Formatter\Contract\FormatterInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class AdvertiserBFormatter
 *
 * @package App\Service\Formatter
 */
class AdvertiserBFormatter implements FormatterInterface
{
    /**
     * @param array $data
     *
     * @return ArrayCollection
     */
    public function format(array $data): ArrayCollection
    {
        $rooms = new ArrayCollection();
        foreach ($data as $hotelData) {

            $hotel = $this->buildHotel($hotelData);

            foreach ($hotelData['rooms'] as $room) {
                $tax = $this->buildTaxes($room['taxes']);
                $room = $this->buildRoom($room, $hotel, $tax);
                $rooms->add($room);
            }
        }

        return $rooms;
    }

    /**
     * @param array $roomData
     * @param Hotel $hotel
     * @param array $taxes
     *
     * @return Room $room
     */
    protected function buildRoom(array $roomData, Hotel $hotel, array $taxes): Room
    {
        $room = new Room();
        $room
            ->setCode($roomData['code'])
            ->setName($roomData['name'])
            ->setNetPrice($roomData['net_rate'])
            ->setTotalPrice($roomData['totalPrice'])
            ->setHotel($hotel)
            ->setTaxes($taxes)
        ;

        return $room;
    }

    protected function buildHotel(array $hotelData): Hotel
    {
        $hotel = new Hotel();
        $hotel
            ->setName($hotelData['name'])
            ->setStars($hotelData['stars'])
        ;

        return $hotel;
    }

    /**
     * @param array $taxes
     *
     * @return array
     */
    protected function buildTaxes(array $taxes): array
    {
        $taxObjects = [];
        foreach ($taxes as $tax) {
            $taxObject = new Tax();
            $taxObject
                ->setAmount($tax['amount'])
                ->setCurrency($tax['currency'])
                ->setType($tax['type'])
            ;
        }

        return $taxObjects;
    }
}
