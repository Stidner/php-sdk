<?php

namespace Stidner\Marshaller\FromObject;

use Stidner\Model\Customer;

class CustomerMarshaller extends AbstractFromObjectMarshaller
{
    public function createFromObject($object)
    {
        $address = new Customer();

        $this->copyProperties($address, $object);

        return $address;
    }
}
