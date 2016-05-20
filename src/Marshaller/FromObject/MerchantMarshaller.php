<?php

namespace Stidner\Marshaller\FromObject;

use Stidner\Model\Merchant;

class MerchantMarshaller extends AbstractFromObjectMarshaller
{
    public function createFromObject($object)
    {
        $address = new Merchant();

        $this->copyProperties($address, $object);

        return $address;
    }
}
