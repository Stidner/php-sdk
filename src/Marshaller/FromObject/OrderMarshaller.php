<?php

namespace Stidner\Marshaller\FromObject;

use Stidner\Marshaller\FromObject\Order\ItemMarshaller;
use Stidner\Marshaller\FromObject\Order\OptionsMarshaller;
use Stidner\Model\Order;

class OrderMarshaller extends AbstractFromObjectMarshaller
{
    /**
     * @var AddressMarshaller
     */
    protected $addressMarshaller;

    /**
     * @var MerchantMarshaller
     */
    protected $merchantMarshaller;

    /**
     * @var ItemMarshaller
     */
    protected $itemMarshaller;

    /**
     * @var OptionsMarshaller
     */
    protected $optionsMarshaller;

    public function __construct()
    {
        $this->addressMarshaller = new AddressMarshaller();
        $this->merchantMarshaller = new MerchantMarshaller();
        $this->itemMarshaller = new ItemMarshaller();
        $this->optionsMarshaller = new OptionsMarshaller();
    }

    public function createFromObject($object)
    {
        $order = new Order();

        $this->copyProperties($order, $object);

        return $order;
    }

    protected function copyProperties($destinationClass, $object)
    {
        foreach (get_object_vars($object) as $name => $value) {
            $methodName = 'set'.$this->camelize($name);

            switch ($name) {
                case 'billing_address':
                case 'shipping_address':
                    $value = $this->addressMarshaller->createFromObject($value);
                    break;

                case 'merchant_urls':
                    $value = $this->merchantMarshaller->createFromObject($value);
                    break;

                case 'created_date':
                case 'completed_date':
                case 'updated_date':
                    $value = new \DateTime($value);
                    break;

                case 'options':
                    $value = $this->optionsMarshaller->createFromObject($value);
                    break;

                case 'items':
                    $items = [];
                    foreach ($value as $apiItem) {
                        $items[] = $this->itemMarshaller->createFromObject($apiItem);
                    }
                    $destinationClass->$methodName($items);
                    break;
            }

            if ($name !== 'items' && method_exists($destinationClass, $methodName)) {
                $destinationClass->$methodName($value);
            }
        }
    }
}
