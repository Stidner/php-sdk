<?php

namespace Stidner\Payment\PaymentHandler;

use Stidner\Model\Order;

abstract class AbstractPaymentHandler implements PaymentHandlerInterface
{
    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $completeUrl;

    public function __construct($orderId, $completeUrl)
    {
        $this->orderId = $orderId;
        $this->completeUrl = $completeUrl;
    }
}
