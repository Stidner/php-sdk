<?php

namespace Stidner\Marshaller\ToArray;

use Stidner\Interfaces\ToArrayInterface;


class AddressMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /*
         * @var Address $object
         */
        $data = [
            'type'            => $object->getType(),
            'addressLine'     => $object->getAddressLine(),
            'postalCode'      => $object->getPostalCode(),
            'city'            => $object->getCity(),
            'region'          => $object->getRegion(),
            'phone'           => $object->getPhone(),
            'email'           => $object->getEmail(),
            'countryCode'     => $object->getCountryCode(),
        ];

        if ($object->getType() == 'business') {
            $data['business_name'] = $object->getBusinessName();
        }
        else
        {
            $data['first_name'] = $object->getFirstName();
            $data['family_name'] = $object->getFamilyName();
        }

        $optionalParameters = [
            'title'           => 'getTitle',
            'addressLine2'    => 'getAddressLine2',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
