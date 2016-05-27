<?php

namespace Stidner\Marshaller\FromObject\Order;

use Stidner\Marshaller\FromObject\AbstractFromObjectMarshaller;
use Stidner\Model\Order\Item;

class ItemMarshaller extends AbstractFromObjectMarshaller
{
    public function createFromObject($object)
    {
        $address = new Item();

        $this->copyProperties($address, $object);

        return $address;
    }
}
