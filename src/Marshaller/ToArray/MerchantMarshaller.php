<?php

namespace Stidner\Marshaller\ToArray;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Model\Merchant;

class MerchantMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /*
         * @var Merchant $object
         */
        $data = [
            'terms'        => $object->getTerms(),
            'checkout'     => $object->getCheckout(),
            'confirmation' => $object->getConfirmation(),
        ];

        $optionalParameters = [
            'push'     => 'getPush',
            'discount' => 'getDiscount',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
