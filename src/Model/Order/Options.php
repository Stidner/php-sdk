<?php

namespace Stidner\Model\Order;

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
