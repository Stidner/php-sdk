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
 * Class Options.
 */
class Options
{
    /**
     * @var string
     */
    protected $colorButton;

    /**
     * @var string
     */
    protected $colorButtonText;

    /**
     * @var string
     */
    protected $colorCheckbox;

    /**
     * @var string
     */
    protected $colorCheckboxCheckmarks;

    /**
     * @var string
     */
    protected $colorHeader;

    /**
     * @var string
     */
    protected $colorLink;

    /**
     * @var string
     */
    protected $colorBackground;

    /**
     * @var string
     */
    protected $colorLinkHover;

    /**
     * @var string
     */
    protected $colorButtonHover;

    /**
     * @var string
     */
    protected $colorDropdownHover;

    /**
     * @var string
     */
    protected $colorDropdownBorder;

    /**
     * @var string
     */
    protected $colorTextboxBorder;

    /**
     * @return string
     */
    public function getColorButton()
    {
        return $this->colorButton;
    }

    /**
     * @param string $colorButton
     *
     * @return $this
     */
    public function setColorButton($colorButton)
    {
        $this->colorButton = $colorButton;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorButtonText()
    {
        return $this->colorButtonText;
    }

    /**
     * @param string $colorButtonText
     *
     * @return $this
     */
    public function setColorButtonText($colorButtonText)
    {
        $this->colorButtonText = $colorButtonText;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorCheckbox()
    {
        return $this->colorCheckbox;
    }

    /**
     * @param string $colorCheckbox
     *
     * @return $this
     */
    public function setColorCheckbox($colorCheckbox)
    {
        $this->colorCheckbox = $colorCheckbox;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorCheckboxCheckmarks()
    {
        return $this->colorCheckboxCheckmarks;
    }

    /**
     * @param string $colorCheckboxCheckmarks
     *
     * @return $this
     */
    public function setColorCheckboxCheckmarks($colorCheckboxCheckmarks)
    {
        $this->colorCheckboxCheckmarks = $colorCheckboxCheckmarks;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorHeader()
    {
        return $this->colorHeader;
    }

    /**
     * @param string $colorHeader
     *
     * @return $this
     */
    public function setColorHeader($colorHeader)
    {
        $this->colorHeader = $colorHeader;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorLinkHover()
    {
        return $this->colorLinkHover;
    }

    /**
     * @param string $colorLinkHover
     *
     * @return $this
     */
    public function setColorLinkHover($colorLinkHover)
    {
        $this->colorLinkHover = $colorLinkHover;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorButtonHover()
    {
        return $this->colorButtonHover;
    }

    /**
     * @param string $colorButtonHover
     *
     * @return $this
     */
    public function setColorButtonHover($colorButtonHover)
    {
        $this->colorButtonHover = $colorButtonHover;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorDropdownHover()
    {
        return $this->colorDropdownHover;
    }

    /**
     * @param string $colorDropdownHover
     *
     * @return $this
     */
    public function setColorDropdownHover($colorDropdownHover)
    {
        $this->colorDropdownHover = $colorDropdownHover;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorDropdownBorder()
    {
        return $this->colorDropdownBorder;
    }

    /**
     * @param string $colorDropdownBorder
     *
     * @return $this
     */
    public function setColorDropdownBorder($colorDropdownBorder)
    {
        $this->colorDropdownBorder = $colorDropdownBorder;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorTextboxBorder()
    {
        return $this->colorTextboxBorder;
    }

    /**
     * @param string $colorTextboxBorder
     *
     * @return $this
     */
    public function setColorTextboxBorder($colorTextboxBorder)
    {
        $this->colorTextboxBorder = $colorTextboxBorder;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorLink()
    {
        return $this->colorLink;
    }

    /**
     * @param string $colorLink
     *
     * @return $this
     */
    public function setColorLink($colorLink)
    {
        $this->colorLink = $colorLink;

        return $this;
    }

    /**
     * @return string
     */
    public function getColorBackground()
    {
        return $this->colorBackground;
    }

    /**
     * @param string $colorBackground
     *
     * @return $this
     */
    public function setColorBackground($colorBackground)
    {
        $this->colorBackground = $colorBackground;

        return $this;
    }
}
