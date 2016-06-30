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

namespace Stidner;

use Httpful\Request;
use Stidner\Api\ResponseException;
use Stidner\Marshaller\FromObject\OrderMarshaller as FromObjectOrderMarshaller;
use Stidner\Marshaller\ToArray\OrderMarshaller as ToArrayOrderMarshaller;
use Stidner\Model\Order;

/**
 * Class to make using the Stidner Order API easier.
 * @package Stidner
 */
class Api
{
    /**
     * @var string The hostname of Stidner's API. Defaults to 'api.stidner.com'.
     */
    private $apiHost;

    /**
     * @var string Your user-ID for the Stidner API.
     */
    private $username;

    /**
     * @var string Your API-key for the Stidner API.
     */
    private $password;

    /**
     * @var ToArrayOrderMarshaller Marshaller for the SDK's PHP arrays -> json object.
     */
    private $orderMarshaller;

    /**
     * @var FromObjectOrderMarshaller Marshaller for the API server's json response -> PHP array.
     */
    private $objectOrderMarshaller;

    /**
     * Api constructor.
     *
     * @param int    $username Your user-ID for the Stidner API.
     * @param string $password Your API-key for the Stidner API.
     * @param string $apiHost  The hostname of Stidner's API. Defaults to 'api.stidner.com'.
     */
    public function __construct($username, $password, $apiHost = 'api.stidner.com')
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiHost = $apiHost;
        $this->orderMarshaller = new ToArrayOrderMarshaller();
        $this->objectOrderMarshaller = new FromObjectOrderMarshaller();
    }

    /**
     * Bundles together the $order data, and POSTs it to Stidner's API server.
     *
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
            $response = Request::post('https://'.$this->apiHost.'/v1/order', $orderData)
                ->addHeader('Authorization', $this->encodeCredentials())
                ->sendsJson()->send();
        } catch (\Exception $e) {
            throw new ResponseException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->content_type !== 'application/json') {
            throw new ApiException('Received wrong content_type response: '.$response->content_type);
        }

        if ($response->code !== 200) {
            throw new ApiException($response, $response->body->status);
        }

        return $this->objectOrderMarshaller->createFromObject($response->body->data);
    }

    /**
     * Makes a base64-encoded string from $this->username:$this->password
     *
     * @return string a base64-encoded string.
     */
    protected function encodeCredentials()
    {
        return 'Basic '.base64_encode($this->username.':'.$this->password);
    }

    /**
     * GETs an order's information from Stidner's API server, using the given order ID.
     *
     * This only needs be used if you want to re-fetch an existing order's information.
     *
     * @param string $orderID An order ID
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
            $response = Request::get('https://'.$this->apiHost.'/v1/order/'.$orderID)
                ->addHeader('Authorization', $this->encodeCredentials())
                ->send();
        } catch (\Exception $e) {
            throw new ResponseException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->content_type !== 'application/json') {
            throw new ApiException('Received wrong content_type response: '.$response->content_type);
        }

        if ($response->code !== 200) {
            throw new ApiException($response, $response->body->status);
        }

        return $this->objectOrderMarshaller->createFromObject($response->body->data);
    }
}
