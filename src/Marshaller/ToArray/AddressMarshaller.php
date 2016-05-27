<?php

namespace Stidner\Marshaller\ToArray;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Model\Address;

class AddressMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /*
         * @var Address $object
         */
        $data = [];

        $optionalParameters = [
            'business_name'   => 'getBusinessName',
            'first_name'      => 'getFirstName',
            'family_name'     => 'getFamilyName',
            'title'           => 'getTitle',
            'street_address'  => 'getStreetAddress',
            'street_address2' => 'getStreetAddress',
            'postal_code'     => 'getPostalCode',
            'city'            => 'getCity',
            'region'          => 'getRegion',
            'phone'           => 'getPhone',
            'country'         => 'getCountry',
            'email'           => 'getEmail',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
