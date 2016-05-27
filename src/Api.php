<?php

namespace Stidner;

use Httpful\Request;
use Stidner\Api\ResponseException;
use Stidner\Marshaller\FromObject\OrderMarshaller as FromObjectOrderMarshaller;
use Stidner\Marshaller\ToArray\OrderMarshaller as ToArrayOrderMarshaller;
use Stidner\Model\Order;
use Stidner\Payment\PaymentHandler\PayPalHandler;
use Stidner\Payment\PaymentHandler\StandardHandler;

/**
 * Class to make using Stidner API easier
 *
 * @author Bartłomiej Kiełbasa <bartlomiej.kielbasa@gmail.com>
 * @package Stidner
 */
class Api
{
    private $apiHost = 'api.stidner.com';
    private $apiCompleteHost = 'complete.stidner.com';
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
     * @var ToArrayOrderMarshaller
     */
    private $orderMarshaller;

    /**
     * @var FromObjectOrderMarshaller
     */
    private $objectOrderMarshaller;

    /**
     * Api constructor.
     * @param $username
     * @param $password
     * @param string $protocol Possible values: http, https
     */
    public function __construct($username, $password, $protocol = 'http')
    {
        $this->username = $username;
        $this->password = $password;
        $this->protocol = $protocol;
        $this->orderMarshaller = new ToArrayOrderMarshaller();
        $this->objectOrderMarshaller = new FromObjectOrderMarshaller();
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
        $response = null;

        try {
            $response = Request::post($this->getUrl().'/v1/order', $orderData)
                ->sendsJson()->send();

            if ($response->code == 400) {
                throw new ApiException('Authentication failed', 400);
            }

            if ($response->body->status > 400) {
                throw new ResponseException($response->body->message, $response->body->status, null, $response->body->details);
            }
        } catch (\Exception $e) {
            throw new ResponseException($e->getMessage(), $e->getCode(), $e);
        }

        $order = $this->objectOrderMarshaller->createFromObject($response->body->data);

        return $order;
    }

    /**
     * Method handles the payment checkout action.
     * @param $orderId
     */
    public function handleCheckout($orderId)
    {
        $get = $_GET;
        $handler = null;

        if (isset($get['token']) && isset($get['PayerID'])) {
            $handler = new PayPalHandler($orderId, $this->apiCompleteHost, $get['token'], $get['PayerID']);
        } else {
            $handler = new StandardHandler($orderId, $this->apiCompleteHost);
        }

        $handler->handleCheckout();
    }

    /**
     * Returns full URL to complete site of the payment. It should be loaded in an iframe.
     *
     * @param $orderId
     * @return string
     */
    public function getCompleteUrl($orderId)
    {
        return $this->protocol.'://'.$this->apiCompleteHost.'/order/'.$orderId;
    }

    protected function getUrl()
    {
        return $this->protocol.'://'.$this->username.':'.$this->password.'@'.$this->apiHost;
    }
}
