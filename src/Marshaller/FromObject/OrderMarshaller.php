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
     * @var CustomerMarshaller
     */
    protected $customerMarshaller;

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
        $this->customerMarshaller = new CustomerMarshaller();
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

            if (in_array($name, ['billing_address', 'shipping_address'])) {
                $value = $this->addressMarshaller->createFromObject($value);
                $destinationClass->$methodName($value);
                continue;
            }

            if (in_array($name, ['customer'])) {
                $value = $this->customerMarshaller->createFromObject($value);
                $destinationClass->$methodName($value);
                continue;
            }

            if (in_array($name, ['merchant_urls'])) {
                $value = $this->merchantMarshaller->createFromObject($value);
                $destinationClass->setMerchantUrl($value);
                continue;
            }

            if (in_array($name, ['created_date', 'completed_date', 'updated_date'])) {
                $value = new \DateTime($value);
                $destinationClass->$methodName($value);
                continue;
            }

            if (in_array($name, ['options'])) {
                $value = $this->optionsMarshaller->createFromObject($value);
                $destinationClass->$methodName($value);
                continue;
            }

            if (in_array($name, ['items'])) {
                $items = [];

                foreach ($value as $apiItem) {
                    $items[] = $this->itemMarshaller->createFromObject($apiItem);
                }

                $destinationClass->$methodName($items);
                continue;
            }

            if (method_exists($destinationClass, $methodName)) {
                $destinationClass->$methodName($value);
            }
        }
    }
}
