<?php

namespace App\Service\Formatter;

use App\Model\Hotel;
use App\Model\Room;
use App\Model\Tax;
use App\Service\Formatter\Contract\FormatterInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class AdvertiserAFormatter
 *
 * @package App\Service\Formatter
 */
class AdvertiserAFormatter implements FormatterInterface
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
                $taxes = $this->buildTaxes($room['taxes']);
                $room = $this->buildRoom($room, $hotel, $taxes);
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
            ->setNetPrice($roomData['net_price'])
            ->setTotalPrice($roomData['total'])
            ->setHotel($hotel)
            ->setTaxes($taxes)
        ;

        return $room;
    }

    /**
     * @param array $hotelData
     *
     * @return Hotel
     */
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
     * @return Tax[]
     */
    protected function buildTaxes(array $taxes): array
    {
        $tax = new Tax();
        $tax
            ->setAmount($taxes['amount'])
            ->setCurrency($taxes['currency'])
            ->setType($taxes['type'])
        ;

        return [$tax];
    }
}
