<?php

namespace Stidner\Marshaller;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Marshaller\Order\ItemToArrayMarshaller;
use Stidner\Marshaller\Order\OptionsToArrayMarshaller;
use Stidner\Model\Order;

class OrderToArrayMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /*
         * @var Order $object
         */

        $merchantMarshaller = new MerchantToArrayMarshaller();
        $optionsMarshaller = new OptionsToArrayMarshaller();
        $itemMarshaller = new ItemToArrayMarshaller();
        $addressMarshaller = new AddressToArrayMarshaller();
        $customerMarshaller = new CustomerToArrayMarshaller();

        $data = [
            'purchase_country'          => $object->getPurchaseCountry(),
            'purchase_currency'         => $object->getPurchaseCurrency(),
            'locale'                    => $object->getLocale(),
            'total_price_excluding_tax' => $object->getTotalPriceExcludingTax(),
            'total_price_including_tax' => $object->getTotalPriceIncludingTax(),
            'total_tax_amount'          => $object->getTotalTaxAmount(),
            'merchant_urls'             => $merchantMarshaller->toArray($object->getMerchantUrl()),
            'items'                     => [],
            'options'                   => $optionsMarshaller->toArray($object->getOptions()),
            'shipping_countries'        => $object->getShippingCountries(),
        ];

        foreach ($object->getItems() as $item) {
            $data['items'][] = $itemMarshaller->toArray($item);
        }

        if ($object->getBillingAddress()) {
            $data['billing_address'] = $addressMarshaller->toArray($object->getBillingAddress());
        }

        if ($object->getShippingAddress()) {
            $data['shipping_address'] = $addressMarshaller->toArray($object->getShippingAddress());
        }

        if ($object->getCustomer()) {
            $data['customer'] = $customerMarshaller->toArray($object->getCustomer());
        }

        $optionalParameters = [
            'merchant_reference1' => 'getMerchantReference1',
            'merchant_reference2' => 'getMerchantReference2',
        ];

        foreach ($optionalParameters as $key => $value) {
            if ($object->$value()) {
                $data[$key] = $object->$value();
            }
        }

        return $data;
    }
}
