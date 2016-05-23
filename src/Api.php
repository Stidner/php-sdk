<?php

namespace Stidner;

use Httpful\Request;
use Stidner\Api\ResponseException;
use Stidner\Marshaller\OrderToArrayMarshaller;
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

    /**
     * @var OrderToArrayMarshaller
     */
    private $orderMarshaller;

    public function __construct($username, $password, $protocol = 'http')
    {
        $this->username = $username;
        $this->password = $password;
        $this->protocol = $protocol;
        $this->orderMarshaller = new OrderToArrayMarshaller();
    }

    /**
     * @param Order $order
     *
     * @throws ApiException      throws when username or password is invalid
     * @throws ResponseException
     *
     * @return Order
     */
    public function createOrder(Order $order)
    {
        $orderData = $this->orderMarshaller->toArray($order);

        $response = Request::post($this->getUrl().'/v1/order', $orderData)
            ->sendsJson()->send();

        if ($response->code == 400) {
            throw new ApiException('Authentication failed', 400);
        }

        if ($response->body->status > 400) {
            throw new ResponseException($response->body->message, $response->body->status, null, $response->body->details);
        }

        $order->setOrderId($response->body->data->order_id);

        return $order;
    }

    protected function getUrl()
    {
        return $this->protocol.'://'.$this->username.':'.$this->password.'@'.$this->apiHost;
    }
}
