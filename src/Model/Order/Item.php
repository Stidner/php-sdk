<?php

namespace Stidner\Model\Order;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Traits\PriceTrait;

class Item implements ToArrayInterface
{
    use PriceTrait;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $artno;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var integer
     */
    protected $weight;

    /**
     * @var integer
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $quantityUnit;

    /**
     * @var integer
     */
    protected $unitPrice;

    /**
     * @var integer
     */
    protected $taxRate;

    /**
     * @var string
     */
    protected $imageUrl;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getArtno()
    {
        return $this->artno;
    }

    /**
     * @param string $artno
     *
     * @return $this
     */
    public function setArtno($artno)
    {
        $this->artno = $artno;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuantityUnit()
    {
        return $this->quantityUnit;
    }

    /**
     * @param string $quantityUnit
     *
     * @return $this
     */
    public function setQuantityUnit($quantityUnit)
    {
        $this->quantityUnit = $quantityUnit;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param int $unitPrice
     *
     * @return $this
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param int $taxRate
     *
     * @return $this
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function toArray()
    {
        $data = [
            'type' => $this->type,
            'artno' => $this->artno,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'tax_rate' => $this->taxRate,
            'total_price_excluding_tax' => $this->totalPriceExcludingTax,
            'total_price_including_tax' => $this->totalPriceIncludingTax,
            'total_tax_amount' => $this->totalTaxAmount,
        ];

        if ($this->type == 'physical') {
            $data['weight'] = $this->weight;
            $data['quantity_unit'] = $this->quantityUnit;
        }

        $optionalParameters = [
            'sku' => 'sku',
            'description' => 'description',
            'image_url' => 'imageUrl'
        ];

        foreach ($optionalParameters as $key => $value) {
            if (!isset($this->$value)) {
                $data[$key] = $this->$value;
            }
        }

        return $data;
    }
}
