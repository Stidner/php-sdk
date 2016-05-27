<?php

namespace Stidner\Payment\PaymentHandler;

class PayPalHandler extends AbstractPaymentHandler
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $payerId;

    public function __construct($orderId, $completeUrl, $token = null, $payerId = null)
    {
        parent::__construct($orderId, $completeUrl);
        $this->token = $token;
        $this->payerId = $payerId;
    }

    public function handleCheckout()
    {
        $url = sprintf($this->completeUrl.'/order/'.$this->orderId.'/?token=%s&PayerID=%s', $this->token, $this->payerId);
        header('Location: '.$url);
        exit;
    }
}
