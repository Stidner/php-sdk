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

/**
 * Class AddressMarshaller.
 */
class AddressMarshaller implements ToArrayInterface
{
    /**
     * @param $object
     *
     * @return array
     */
    public function toArray($object)
    {
        /*
         * @var Address $object
         */
        $data = [
            'type'        => $object->getType(),
            'addressLine' => $object->getAddressLine(),
            'postalCode'  => $object->getPostalCode(),
            'city'        => $object->getCity(),
            'region'      => $object->getRegion(),
            'phone'       => $object->getPhone(),
            'email'       => $object->getEmail(),
            'countryCode' => $object->getCountryCode(),
        ];

        if ($object->getType() === 'business') {
            $data['business_name'] = $object->getBusinessName();
        } else {
            $data['first_name'] = $object->getFirstName();
            $data['family_name'] = $object->getFamilyName();
        }

        $optionalParameters = [
            'title'        => 'getTitle',
            'addressLine2' => 'getAddressLine2',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
