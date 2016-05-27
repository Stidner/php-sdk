<?php

namespace Stidner\Marshaller\FromObject\Order;

use Stidner\Marshaller\FromObject\AbstractFromObjectMarshaller;
use Stidner\Model\Order\Options;

class OptionsMarshaller extends AbstractFromObjectMarshaller
{
    public function createFromObject($object)
    {
        $address = new Options();

        $this->copyProperties($address, $object);

        return $address;
    }

    protected function copyProperties($destinationClass, $object)
    {
        foreach ($object as $name => $value) {
            $methodName = 'set'.$this->camelize($name);

            if (method_exists($destinationClass, $methodName)) {
                $destinationClass->$methodName($value);
            }
        }
    }
}
