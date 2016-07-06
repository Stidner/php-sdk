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
namespace Stidner\Model;

use Stidner\Model\Order\Options;
use Stidner\Traits\PriceTrait;

/**
 * Class Order.
 */
class Order
{
    use PriceTrait;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $iframeUrl;

    /**
     * @var string
     */
    protected $purchaseCountry;

    /**
     * @var string
     */
    protected $purchaseCurrency;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $shipmentStatus;

    /**
     * @var string
     */
    protected $shipmentCarrier;

    /**
     * @var string
     */
    protected $shipmentProduct;


    /**
     * @var Address
     */
    protected $billingAddress;

    /**
     * @var Address
     */
    protected $shippingAddress;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var bool
     */
    protected $freeShipping;

    /**
     * @var Merchant
     */
    protected $merchantUrl;

    /**
     * @var string
     */
    protected $merchantReference1;

    /**
     * @var string
     */
    protected $merchantReference2;

    /**
     * @var \DateTime
     */
    protected $createdDate;

    /**
     * @var \DateTime
     */
    protected $completedDate;

    /**
     * @var \DateTime
     */
    protected $updatedDate;

    /**
     * @var array
     */
    protected $shipmentCountries = [];

    /**
     * @var Order\Item[]
     */
    protected $items = [];

    /**
     * @var Options
     */
    protected $options;

    /**
     * Create constructor.
     */
    public function __construct()
    {
        $this->options = new Options();
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string
     */
    public function getIframeUrl()
    {
        return $this->iframeUrl;
    }

    /**
     * @param string $iframeUrl
     *
     * @return $this
     */
    public function setIframeUrl($iframeUrl)
    {
        $this->iframeUrl = $iframeUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getPurchaseCountry()
    {
        return $this->purchaseCountry;
    }

    /**
     * @param string $purchaseCountry
     *
     * @return $this
     */
    public function setPurchaseCountry($purchaseCountry)
    {
        $this->purchaseCountry = $purchaseCountry;

        return $this;
    }

    /**
     * @return string
     */
    public function getPurchaseCurrency()
    {
        return $this->purchaseCurrency;
    }

    /**
     * @param string $purchaseCurrency
     *
     * @return $this
     */
    public function setPurchaseCurrency($purchaseCurrency)
    {
        $this->purchaseCurrency = $purchaseCurrency;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return string Returns "purchase_incomplete" (default), "purchase_complete", or "purchase_refunded".
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string Returns "choosing_provider" (default), "pending", or "shipped".
     */
    public function getShipmentStatus()
    {
        return $this->shipmentStatus;
    }

    /**
     * @param string $shipmentStatus
     *
     * @return $this
     */
    public function setShipmentStatus($shipmentStatus)
    {
        $this->shipmentStatus = $shipmentStatus;

        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentCarrier()
    {
        return $this->shipmentCarrier;
    }

    /**
     * @param string $shipmentCarrier
     *
     * @return $this
     */
    public function setShipmentCarrier($shipmentCarrier)
    {
        $this->shipmentCarrier = $shipmentCarrier;

        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentProduct()
    {
        return $this->shipmentProduct;
    }

    /**
     * @param string $shipmentProduct
     *
     * @return $this
     */
    public function setShipmentProduct($shipmentProduct)
    {
        $this->shipmentProduct = $shipmentProduct;

        return $this;
    }

    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param Address $billingAddress
     *
     * @return $this
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * @return Address
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @param Address $shippingAddress
     *
     * @return $this
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     *
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return string
     */
    public function getFreeShipping()
    {
        return $this->freeShipping;
    }

    /**
     * @param bool $freeShipping
     *
     * @return $this
     */
    public function setFreeShipping($freeShipping)
    {
        $this->freeShipping = (bool) $freeShipping;

        return $this;
    }

    /**
     * @return Merchant
     */
    public function getMerchantUrls()
    {
        return $this->merchantUrl;
    }

    /**
     * @param Merchant $merchantUrl
     *
     * @return $this
     */
    public function setMerchantUrls($merchantUrl)
    {
        $this->merchantUrl = $merchantUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantReference1()
    {
        return $this->merchantReference1;
    }

    /**
     * @param string $merchantReference1
     *
     * @return $this
     */
    public function setMerchantReference1($merchantReference1)
    {
        $this->merchantReference1 = $merchantReference1;

        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantReference2()
    {
        return $this->merchantReference2;
    }

    /**
     * @param string $merchantReference2
     *
     * @return $this
     */
    public function setMerchantReference2($merchantReference2)
    {
        $this->merchantReference2 = $merchantReference2;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime $createdDate
     *
     * @return $this
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCompletedDate()
    {
        return $this->completedDate;
    }

    /**
     * @param \DateTime $completedDate
     *
     * @return $this
     */
    public function setCompletedDate($completedDate)
    {
        $this->completedDate = $completedDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param \DateTime $updatedDate
     *
     * @return $this
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * @return array
     */
    public function getShipmentCountries()
    {
        return $this->shipmentCountries;
    }

    /**
     * @param array $shipmentCountries
     *
     * @return $this
     */
    public function setShipmentCountries($shipmentCountries)
    {
        $this->shipmentCountries = $shipmentCountries;

        return $this;
    }

    /**
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param Options $options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return Order\Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Order\Item[] $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param Order\Item $item
     *
     * @return $this
     */
    public function addItem(Order\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }
}
