<?php

namespace Stidner\Payment\PaymentHandler;

class StandardHandler extends AbstractPaymentHandler
{
    public function handleCheckout()
    {
        header('Location: '.$this->completeUrl.'/order/'.$this->orderId);exit;
    }
}
