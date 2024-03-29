<?php


namespace App\Model;

use App\Model\Hotel;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Room
{
    /**
     * @var string $code
     * @SerializedName("code")
     */
    public $code;

    /**
     * @var string|null $name
     * @SerializedName("name")
     */
    protected $name;

    /**
     * @var string $netPrice
     * @SerializedName("net_price")
     */
    protected $netPrice;

    /**
     * @var string $totalPrice
     * @SerializedName("total_price")
     */
    protected $totalPrice;

    /**
     * @var Tax[] $taxes
     * @SerializedName("taxes")
     */
    protected $taxes;

    /**
     * @var Hotel $hotel
     * @SerializedName("hotel")
     */
    protected $hotel;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getNetPrice(): string
    {
        return $this->netPrice;
    }

    /**
     * @param string $netPrice
     *
     * @return $this
     */
    public function setNetPrice(string $netPrice): self
    {
        $this->netPrice = $netPrice;

        return $this;
    }

    /**
     * @return string
     */
    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }

    /**
     * @param string $totalPrice
     *
     * @return $this
     */
    public function setTotalPrice(string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return Tax[]
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    /**
     * @param array $taxes
     *
     * @return $this
     */
    public function setTaxes(array $taxes): self
    {
        $this->taxes = $taxes;

        return $this;
    }

    /**
     * @return Hotel
     */
    public function getHotel(): Hotel
    {
        return $this->hotel;
    }

    /**
     * @param \App\Model\Hotel $hotel
     *
     * @return $this
     */
    public function setHotel(Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
