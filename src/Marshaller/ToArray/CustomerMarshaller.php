<?php

namespace Stidner\Marshaller\ToArray;

use Stidner\Interfaces\ToArrayInterface;

class CustomerMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /*
         * @var Customer $object
         */
        $data = [];

        $optionalParameters = [
            'email' => 'getEmail',
            'phone' => 'getPhone',
            'orgno' => 'getOrgno',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
