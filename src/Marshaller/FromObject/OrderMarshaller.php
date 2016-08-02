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
namespace Stidner\Marshaller\FromObject;

use Stidner\Marshaller\FromObject\Order\ItemMarshaller;
use Stidner\Marshaller\FromObject\Order\OptionsMarshaller;
use Stidner\Model\Order;

/**
 * Class OrderMarshaller.
 *
 * Marshaller for the API server's json response -> PHP array
 */
class OrderMarshaller extends AbstractFromObjectMarshaller {
    /**
     * @var AddressMarshaller
     */
    protected $addressMarshaller;

    /**
     * @var MerchantMarshaller
     */
    protected $merchantMarshaller;

    /**
     * @var ItemMarshaller
     */
    protected $itemMarshaller;

    /**
     * @var OptionsMarshaller
     */
    protected $optionsMarshaller;

    /**
     * OrderMarshaller constructor.
     */
    public function __construct() {
        $this->addressMarshaller = new AddressMarshaller();
        $this->merchantMarshaller = new MerchantMarshaller();
        $this->itemMarshaller = new ItemMarshaller();
        $this->optionsMarshaller = new OptionsMarshaller();
    }

    /**
     * @param $object
     *
     * @return Order
     */
    public function createFromObject($object) {
        $order = new Order();

        $this->copyProperties($order, $object);

        return $order;
    }

    /**
     * @param $destinationClass
     * @param $object
     */
    protected function copyProperties($destinationClass, $object) {
        foreach (get_object_vars($object) as $name => $value) {
            $methodName = 'set' . $this->camelize($name);

            switch ($name) {
                case 'billing_address':
                case 'shipping_address':
                    $value = $this->addressMarshaller->createFromObject($value);
                    break;

                case 'merchant_urls':
                    $value = $this->merchantMarshaller->createFromObject($value);
                    break;

                case 'created_date':
                case 'completed_date':
                case 'updated_date':
                    $value = new \DateTime($value);
                    break;

                case 'options':
                    $value = $this->optionsMarshaller->createFromObject($value);
                    break;

                case 'items':
                    $items = [];
                    foreach ($value as $apiItem) {
                        $items[] = $this->itemMarshaller->createFromObject($apiItem);
                    }
                    $destinationClass->$methodName($items);
                    break;
            }

            if ($name !== 'items' && method_exists($destinationClass, $methodName)) {
                $destinationClass->$methodName($value);
            }
        }
    }
}
