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
namespace Stidner\Marshaller\ToArray;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Marshaller\ToArray\Order\ItemMarshaller;
use Stidner\Marshaller\ToArray\Order\OptionsMarshaller;
use Stidner\Model\Order;

/**
 * Class OrderMarshaller.
 *
 * Marshalls the SDK's php arrays -> json object.
 *
 * @package Stidner\Marshaller\ToArray
 */
class OrderMarshaller implements ToArrayInterface
{
    /**
     *
     * @param Order $object
     * @return array
     */
    public function toArray($object)
    {
        $merchantMarshaller = new MerchantMarshaller();
        $optionsMarshaller = new OptionsMarshaller();
        $itemMarshaller = new ItemMarshaller();
        $addressMarshaller = new AddressMarshaller();

        $data = [
            'purchase_country'          => $object->getPurchaseCountry(),
            'purchase_currency'         => $object->getPurchaseCurrency(),
            'locale'                    => $object->getLocale(),
            'total_price_excluding_tax' => $object->getTotalPriceExcludingTax(),
            'total_price_including_tax' => $object->getTotalPriceIncludingTax(),
            'total_tax_amount'          => $object->getTotalTaxAmount(),
            'items'                     => [],
            'merchant_urls'             => $merchantMarshaller->toArray($object->getMerchantUrls()),
            'options'                   => $optionsMarshaller->toArray($object->getOptions()),
        ];

        foreach ($object->getItems() as $item) {
            $data['items'][] = $itemMarshaller->toArray($item);
        }

        if ($object->getBillingAddress()) {
            $data['billing_address'] = $addressMarshaller->toArray($object->getBillingAddress());
        }

        $optionalParameters = [
            'merchant_reference1' => 'getMerchantReference1',
            'merchant_reference2' => 'getMerchantReference2',
            'shipment_countries'  => 'getShipmentCountries',
            'free_shipping'       => 'getFreeShipping',
            'comment'             => 'getComment',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
