<?php

namespace Stidner;

use Httpful\Request;
use Stidner\Api\ResponseException;
use Stidner\Marshaller\FromObject\OrderMarshaller as FromObjectOrderMarshaller;
use Stidner\Marshaller\ToArray\OrderMarshaller as ToArrayOrderMarshaller;
use Stidner\Model\Order;

/**
 * Class to make using the Stidner Order API easier.
 */
class Api
{
    private $apiHost = 'test.api.stidner.com';
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
     *
     * @param int $username API user-ID
     * @param string $password API password
     * @param string $protocol Must be https in production.
     */
    public function __construct($username, $password, $protocol = 'https')
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
     * @throws ApiException      throws upon invalid response from Stidner's API
     * @throws ResponseException throws upon Httpful::post failing
     *
     * @return Order
     */
    public function createOrder(Order $order)
    {
        $orderData = $this->orderMarshaller->toArray($order);
        $response = null;

        try {
            $response = Request::post($this->getUrl() . '/v1/order', $orderData)
                ->addHeader('Authorization', $this->encodeCredentials())
                ->sendsJson()->send();
        } catch (\Exception $e) {
            throw new ResponseException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->content_type !== 'application/json') {
            throw new ApiException('Received wrong content_type response: ' . $response->content_type);
        }

        if ($response->code !== 200) {
            throw new ApiException($response, $response->body->status);
        }

        return $this->objectOrderMarshaller->createFromObject($response->body->data);
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->protocol . '://' . $this->apiHost;
    }

    /**
     * @return string
     */
    protected function encodeCredentials()
    {
        return 'Basic ' . base64_encode($this->username . ':' . $this->password);
    }

    /**
     * @param string $orderID
     *
     * @throws ApiException      throws upon invalid response from Stidner's API
     * @throws ResponseException throws upon Httpful::get failing
     *
     * @return Order
     */
    public function getOrder($orderID)
    {
        $response = null;

        try {
            $response = Request::get($this->getUrl() . '/v1/order/' . $orderID)
                ->addHeader('Authorization', $this->encodeCredentials())
                ->send();
        } catch (\Exception $e) {
            throw new ResponseException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->content_type !== 'application/json') {
            throw new ApiException('Received wrong content_type response: ' . $response->content_type);
        }

        if ($response->code !== 200) {
            throw new ApiException($response, $response->body->status);
        }

        return $this->objectOrderMarshaller->createFromObject($response->body->data);
    }
}
