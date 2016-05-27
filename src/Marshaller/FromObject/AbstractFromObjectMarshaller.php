<?php

namespace Stidner\Marshaller\FromObject;

use Stidner\Interfaces\FromObjectMarshaller;

abstract class AbstractFromObjectMarshaller implements FromObjectMarshaller
{
    protected function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }

    protected function copyProperties($destinationClass, $object)
    {

        foreach (get_object_vars($object) as $name => $value) {
            $methodName = 'set'.$this->camelize($name);

            if (method_exists($destinationClass, $methodName)) {
                $destinationClass->$methodName($value);
            }
        }
    }
}
