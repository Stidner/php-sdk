<?php

namespace Stidner\Traits;

trait PriceTrait
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
}
