<?php

namespace Stidner;

use Httpful\Request;
use Stidner\Model\Order;

class Api
{
    private $apiHost = 'api.stidner.com';
    private $protocol;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    public function __construct($username, $password, $protocol = 'http')
    {
        $this->username = $username;
        $this->password = $password;
        $this->protocol = $protocol;
    }

    public function createOrder(Order $order)
    {
        $orderData = $order->toArray();

        $response = Request::post($this->getUrl().'/v1/order', $orderData)
            ->sendsJson()->send();

        if ($response->code == 400) {
            throw new ApiException('Authentication failed');
        }
    }

    protected function getUrl()
    {
        return $this->protocol.'://'.$this->username.':'.$this->password.'@'.$this->apiHost;
    }
}
