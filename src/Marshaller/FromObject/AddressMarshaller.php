<?php

namespace Stidner\Marshaller\FromObject;

use Stidner\Model\Address;

class AddressMarshaller extends AbstractFromObjectMarshaller
{
    public function createFromObject($object)
    {
        $address = new Address();

        $this->copyProperties($address, $object);

        return $address;
    }
}
