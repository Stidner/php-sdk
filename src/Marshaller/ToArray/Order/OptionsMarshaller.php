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

namespace Stidner\Marshaller\ToArray\Order;

use Stidner\Interfaces\ToArrayInterface;

/**
 * Class OptionsMarshaller.
 */
class OptionsMarshaller implements ToArrayInterface
{
    /**
     * @param $object
     *
     * @return array
     */
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
            'color_link_hover'          => 'getColorLinkHover',
            'color_button_hover'        => 'getColorButtonHover',
            'color_dropdown_hover'      => 'getColorDropdownHover',
            'color_dropdown_border'     => 'getColorDropdownBorder',
            'color_textbox_border'      => 'getColorTextboxBorder',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
