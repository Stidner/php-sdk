<?php

namespace Stidner\Marshaller\ToArray\Order;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Model\Order\Item;

class ItemMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /*
         * @var Item $object
         */
        $data = [
            'type'                      => $object->getType(),
            'artno'                     => $object->getArtno(),
            'name'                      => $object->getName(),
            'quantity'                  => $object->getQuantity(),
            'unit_price'                => $object->getUnitPrice(),
            'tax_rate'                  => $object->getTaxRate(),
            'total_price_excluding_tax' => $object->getTotalPriceExcludingTax(),
            'total_price_including_tax' => $object->getTotalPriceIncludingTax(),
            'total_tax_amount'          => $object->getTotalTaxAmount(),
        ];

        if ($object->getType() == 'physical') {
            $data['weight'] = $object->getWeight();
            $data['quantity_unit'] = $object->getQuantityUnit();
        }

        $optionalParameters = [
            'sku'         => 'getSku',
            'description' => 'getDescription',
            'image_url'   => 'getImageUrl',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}