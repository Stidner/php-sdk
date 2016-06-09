<?php

namespace Stidner\Marshaller\ToArray;

use Stidner\Interfaces\ToArrayInterface;
use Stidner\Marshaller\ToArray\Order\ItemMarshaller;
use Stidner\Marshaller\ToArray\Order\OptionsMarshaller;
use Stidner\Model\Order;

class OrderMarshaller implements ToArrayInterface
{
    public function toArray($object)
    {
        /*
         * @var Order $object
         */

        $merchantMarshaller = new MerchantMarshaller();
        $optionsMarshaller = new OptionsMarshaller();
        $itemMarshaller = new ItemMarshaller();
        $addressMarshaller = new AddressMarshaller();
        $customerMarshaller = new CustomerMarshaller();

        $data = [
            'purchase_country'          => $object->getPurchaseCountry(),
            'purchase_currency'         => $object->getPurchaseCurrency(),
            'locale'                    => $object->getLocale(),
            'total_price_excluding_tax' => $object->getTotalPriceExcludingTax(),
            'total_price_including_tax' => $object->getTotalPriceIncludingTax(),
            'total_tax_amount'          => $object->getTotalTaxAmount(),
            'items'                     => [],
            'merchant_urls'             => $merchantMarshaller->toArray($object->getMerchantUrls()),
            'options'                   => $optionsMarshaller->toArray($object->getOptions()),
        ];

        foreach ($object->getItems() as $item) {
            $data['items'][] = $itemMarshaller->toArray($item);
        }

        if ($object->getBillingAddress()) {
            $data['billing_address'] = $addressMarshaller->toArray($object->getBillingAddress());
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
