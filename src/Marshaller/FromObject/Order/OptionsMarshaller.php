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
namespace Stidner\Marshaller\FromObject\Order;

use Stidner\Marshaller\FromObject\AbstractFromObjectMarshaller;
use Stidner\Model\Order\Options;

/**
 * Class OptionsMarshaller.
 */
class OptionsMarshaller extends AbstractFromObjectMarshaller {
    /**
     * @param $object
     *
     * @return Options
     */
    public function createFromObject($object) {
        $address = new Options();

        $this->copyProperties($address, $object);

        return $address;
    }

    /**
     * @param $destinationClass
     * @param $object
     */
    protected function copyProperties($destinationClass, $object) {
        foreach ($object as $name => $value) {
            $methodName = 'set' . $this->camelize($name);

            if (method_exists($destinationClass, $methodName)) {
                $destinationClass->$methodName($value);
            }
        }
    }
}
