<?php
/**
 * Copyright 2016 Stidner Complete AB.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Stidner\Model\Order;

/**
 * Class Item.
 */
class Item
{
    /**
     * @var int
     */
    protected $totalPriceExcludingTax;

    /**
     * @var int
     */
    protected $totalTaxAmount;

    /**
     * @var int
     */
    protected $totalPriceIncludingTax;

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
     * @var int
     */
    protected $weight;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $quantityUnit;

    /**
     * @var int
     */
    protected $unitPrice;

    /**
     * @var int
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

    /**
     * @return int
     */
    public function getTotalPriceExcludingTax()
    {
        return $this->totalPriceExcludingTax;
    }

    /**
     * @param int $totalPriceExcludingTax
     *
     * @return $this
     */
    public function setTotalPriceExcludingTax($totalPriceExcludingTax)
    {
        $this->totalPriceExcludingTax = $totalPriceExcludingTax;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalTaxAmount()
    {
        return $this->totalTaxAmount;
    }

    /**
     * @param int $totalTaxAmount
     *
     * @return $this
     */
    public function setTotalTaxAmount($totalTaxAmount)
    {
        $this->totalTaxAmount = $totalTaxAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPriceIncludingTax()
    {
        return $this->totalPriceIncludingTax;
    }

    /**
     * @param int $totalPriceIncludingTax
     *
     * @return $this
     */
    public function setTotalPriceIncludingTax($totalPriceIncludingTax)
    {
        $this->totalPriceIncludingTax = $totalPriceIncludingTax;

        return $this;
    }

    /**
     * @return $this Returns price values for item.
     *
     * unitPrice, quantity, and taxRate must be set prior to using function.
     */
    public function calculateItemPrice()
    {
        if (!isset($this->unitPrice, $this->quantity, $this->taxRate)) {
            die('ERROR: unitPrice, quantity, or taxRate was not set before calling calculateTotalPrices().');
        }

        $this->totalPriceExcludingTax = ($this->unitPrice * $this->quantity);
        $this->totalTaxAmount = ($this->taxRate * $this->totalPriceExcludingTax / 10000);
        $this->totalPriceIncludingTax = ($this->totalPriceExcludingTax + $this->totalTaxAmount);

        return $this;
    }
}
