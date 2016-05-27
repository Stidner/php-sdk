<?php

namespace Stidner\Marshaller\ToArray\Order;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Model\Order\Options;

class OptionsMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /*
         * @var Options $object
         */
        $data = [];

        $optionalParameters = [
            'color_button'              => 'getColorButton',
            'color_button_text'         => 'getColorButtonText',
            'color_checkbox'            => 'getColorCheckbox',
            'color_checkbox_checkmarks' => 'getColorCheckboxCheckmarks',
            'color_header'              => 'getColorHeader',
            'color_link'                => 'getColorLink',
            'color_background'          => 'getColorBackground',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
