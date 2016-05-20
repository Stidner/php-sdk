<?php

namespace Stidner\Model;

use Stidner\Model\Order\Options;
use Stidner\Traits\PriceTrait;

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
     * @var Customer
     */
    protected $customer;

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
    protected $shippingCountries = [];

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
     * @return string
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
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Merchant
     */
    public function getMerchantUrl()
    {
        return $this->merchantUrl;
    }

    /**
     * @param Merchant $merchantUrl
     *
     * @return $this
     */
    public function setMerchantUrl($merchantUrl)
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
    public function getShippingCountries()
    {
        return $this->shippingCountries;
    }

    /**
     * @param array $shippingCountries
     *
     * @return $this
     */
    public function setShippingCountries($shippingCountries)
    {
        $this->shippingCountries = $shippingCountries;

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

    public function addItem(Order\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }
}
