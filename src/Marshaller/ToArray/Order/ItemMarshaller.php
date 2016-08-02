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
namespace Stidner\Marshaller\ToArray\Order;

use Stidner\Interfaces\ToArrayInterface;

/**
 * Class ItemMarshaller.
 */
class ItemMarshaller implements ToArrayInterface {
    /**
     * @param $object
     *
     * @return array
     */
    public function toArray($object) {
        /*
         * @var Item $object
         */
        $data = [
            'type' => $object->getType(),
            'artno' => $object->getArtno(),
            'name' => $object->getName(),
            'quantity' => $object->getQuantity(),
            'quantity_unit' => $object->getQuantityUnit(),
            'unit_price' => $object->getUnitPrice(),
            'tax_rate' => $object->getTaxRate(),
            'total_price_excluding_tax' => $object->getTotalPriceExcludingTax(),
            'total_price_including_tax' => $object->getTotalPriceIncludingTax(),
            'total_tax_amount' => $object->getTotalTaxAmount(),
        ];

        if ($object->getType() === 'physical') {
            $data['weight'] = $object->getWeight();
        }

        $optionalParameters = [
            'sku' => 'getSku',
            'description' => 'getDescription',
            'image_url' => 'getImageUrl',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
