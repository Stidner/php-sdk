<?php

namespace Stidner\Marshaller;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Model\Customer;

class CustomerToArrayMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /**
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
