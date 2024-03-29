<?php

namespace App\Model;

use App\Model\Room;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class Hotel
 *
 * @package App\Model
 */
class Hotel
{
    /**
     * @var string $name
     *
     * @SerializedName("name")
     * @Groups("search")
     */
    protected $name;

    /**
     * @var int $stars
     * @SerializedName("stars")
     * @Groups("search")
     */
    protected $stars;

    /**
     * @var Room[] $rooms
     */
    protected $rooms;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * @param int $stars
     *
     * @return self
     */
    public function setStars(int $stars): self
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * @return Room[]
     */
    public function getRooms(): ?array
    {
        return $this->rooms;
    }

    /**
     * @param Room[] $rooms
     * @return self
     */
    public function setRooms(array $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }
}
