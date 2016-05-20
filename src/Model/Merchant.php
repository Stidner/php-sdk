<?php

namespace Stidner\Model;

use Stidner\Interfaces\ToArrayInterface;

class Merchant implements ToArrayInterface
{
    /**
     * @var string
     */
    protected $terms;

    /**
     * @var string
     */
    protected $checkout;

    /**
     * @var string
     */
    protected $confirmation;

    /**
     * @var string
     */
    protected $push;

    /**
     * @var string
     */
    protected $discount;

    /**
     * Merchant constructor.
     * @param string $terms
     * @param string $checkout
     * @param string $confirmation
     * @param string $push
     * @param string $discount
     */
    public function __construct($terms, $checkout, $confirmation, $push = NULL, $discount = NULL)
    {
        $this->terms = $terms;
        $this->checkout = $checkout;
        $this->confirmation = $confirmation;
        $this->push = $push;
        $this->discount = $discount;
    }

    /**
     * @return string
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @param string $terms
     *
     * @return $this
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return string
     */
    public function getCheckout()
    {
        return $this->checkout;
    }

    /**
     * @param string $checkout
     *
     * @return $this
     */
    public function setCheckout($checkout)
    {
        $this->checkout = $checkout;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * @param string $confirmation
     *
     * @return $this
     */
    public function setConfirmation($confirmation)
    {
        $this->confirmation = $confirmation;
        return $this;
    }

    /**
     * @return string
     */
    public function getPush()
    {
        return $this->push;
    }

    /**
     * @param string $push
     *
     * @return $this
     */
    public function setPush($push)
    {
        $this->push = $push;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param string $discount
     *
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }

    public function toArray()
    {
        $data = [
            'terms' => $this->terms,
            'checkout' => $this->checkout,
            'confirmation' => $this->confirmation,
        ];

        $optionalParameters = [
            'push' => 'push',
            'discount' => 'discount',
        ];

        foreach ($optionalParameters as $key => $value) {
            if (!isset($this->$value)) {
                $data[$key] = $this->$value;
            }
        }

        return $data;
    }
}
