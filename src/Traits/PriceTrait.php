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
namespace Stidner\Traits;

/**
 * Class PriceTrait.
 */
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
