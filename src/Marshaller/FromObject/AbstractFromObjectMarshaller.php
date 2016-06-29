<?php

namespace Stidner\Marshaller\FromObject;

use Stidner\Interfaces\FromObjectMarshaller;

abstract class AbstractFromObjectMarshaller implements FromObjectMarshaller
{
    protected function camelize($input)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $input)));
    }

    protected function copyProperties($destinationClass, $object)
    {
        if (is_object($object)) {
            foreach (get_object_vars($object) as $name => $value) {
                $methodName = 'set'.$this->camelize($name);

                if (method_exists($destinationClass, $methodName)) {
                    $destinationClass->$methodName($value);
                }
            }
        }
    }
}
