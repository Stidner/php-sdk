[![StyleCI](https://styleci.io/repos/59211152/shield)](https://styleci.io/repos/59211152)

Stidner PHP SDK
===============

# Requirements

At least PHP 5.4.

# Installation

Please install the SDK via [Composer](https://getcomposer.org/).

    composer require stidner/php-sdk

And then load the SDK using Composer's autoload:

    require_once('vendor/autoload.php');

# Dependencies

The SDK depends on:

- The [`Httpful`](https://github.com/nategood/httpful) library,
- and the `curl` extension.

When using Composer, these should be automatically handled.

# Usage

We suggest you read our full documentation at [http://developer.stidner.com](http://developer.stidner.com/?php-sdk).

## Create new order

...but to summarize, you need to:

1) Create a new API instance; this includes your API key and user ID.

```php
$api_handle = new \Stidner\Api(API_USER_ID, 'API_KEY');
```

2) Craft the various objects that the API requires.
Please click the links for complete example code.

Required:
- [merchant URLs](http://developer.stidner.com/?php-sdk#urls-subobject),
- [items array](http://developer.stidner.com/?php-sdk#item-subobject).

Optional:
- [billing address](http://developer.stidner.com/?php-sdk#address-subobject),
- [checkout options](http://developer.stidner.com/?php-sdk#options-subobject).

3) Create the [Order](http://developer.stidner.com/?php-sdk#order-object) object, which contains the above objects and a few final variables.

```php
$order = new \Stidner\Model\Order();
$order->setMerchantReference1(null)
    ->setMerchantReference2(null)
    ->setPurchaseCountry('SE')
    ->setPurchaseCurrency('SEK')
    ->setLocale('sv_se')
    ->setTotalPriceExcludingTax(171000)
    ->setTotalPriceIncludingTax(213750)
    ->setTotalTaxAmount(42750)
    ->setBillingAddress($billingAddress) // Don't forget to add all the objects!
    ->addItem($item[1])
    ->addItem($item[2])
    ->setMerchantUrls($merchant)
    ->setOptions($options);
```

4) Finally, send the now-complete json object off to the API server! If successful, the response should be the entire order object, and include a URL to our Stidner Complete payment system; this URL should be loaded in an iframe on your checkout page!

```php
try {
    $request = $api_handle->createOrder($order);
    $iframeUrl = $request->getIframeUrl();
    echo "<iframe src='$iframeUrl' width='75%' height='75%'></iframe>";
} catch (\Stidner\ApiException $e) {
    print $e;
} catch (\Stidner\Api\ResponseException $e) {
    print $e;
}
```

## Checking an order's status

Same with creating an order, you must create the API instance:

```php
$api_handle = new \Stidner\Api(API_USER_ID, 'API_KEY');
```

Now do getOrder(), with the orderID as a parameter. This loads the entire order json object from the API.

```php
$request = $api_handle->getOrder('ORDER_ID');
```

Finally, getStatus() on the response's json object. This will be: purchase_incomplete, purchase_complete, or purchase_refunded.
```php
$orderStatus = $request->getStatus();
```

# License

Stidner's PHP SDK is licensed under the [Apache License, Version 2](https://www.apache.org/licenses/LICENSE-2.0).