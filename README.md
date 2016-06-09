[![StyleCI](https://styleci.io/repos/59211152/shield)](https://styleci.io/repos/59211152)

Stidner PHP SDK
===============

# Installation and requirements

The SDK requires min PHP 5.5 and curl plugin installed. To install the library use composer:

    composer require Stidner/php-sdk

# Usage

To create new order using Stidner SDK you need to create new API instance. 

```php
$api = new \Stidner\Api(1, 'somepasswordgoeshere');
```

The next step is creating order items. The order item represents a product. Example order item is available below:

```php
$boots = new \Stidner\Model\Order\Item();
$boots->setType('physical')
    ->setArtno(123456)
    ->setName('My favorite boots')
    ->setWeight(1200)
    ->setQuantity(1)
    ->setQuantityUnit('kg')
    ->setUnitPrice(66000)
    ->setTaxRate(2500)
    ->setTotalPriceIncludingTax(82500)
    ->setTotalPriceExcludingTax(66000)
    ->setTotalTaxAmount(16500);
```

All the attributes are described in the API documentation.

## Creating the order

```php
$merchant = new \Stidner\Model\Merchant('http://test.com', 'http://test.com', 'http://test.com');
    
$order = new \Stidner\Model\Order();
    
$order->setPurchaseCountry('PL')
    ->setPurchaseCurrency('PLN')
    ->setLocale('pl_pl')
    ->setTotalPriceIncludingTax(82500)
    ->setTotalPriceExcludingTax(66000)
    ->setTotalTaxAmount(16500)
    ->setMerchantUrls($merchant)
    ->addItem($boots);
```

The three arguments in Merchant model are:

* **terms** - URL to the merchant’s terms and conditions page.
* **checkout** - URL to the merchant’s checkout page.
* **confirmation** - URL to the merchant’s confirmation page.

They are all required.

### Adding address information about customer

To add billing address or shipping address you need to create new instance of Stidner\Model\Address class.

```php
$billingAddress = new \Stidner\Model\Address();

$billingAddress->setFirstName("John")
    ->setCountry('PL')
    ->setFamilyName("Due");
```

and add it to the order

```php
$order->setBillingAddress($billingAddress);
// or
$order->setShippingAddress($shippingAddress);
```

The final step is sending the order information to the server. You can do that by using the Stidner\Api::createOrder method. Example:

```php
try {
    $api->createOrder($order);
}
catch(\Stidner\ApiException $e) {
    // authorization error
}
catch(\Stidner\Api\ResponseException $e) {
    // any other error. You can fetch the messages using Stidner\Api\ResponseException::getMessages method
}
```

Possible error codes are:

 - **200** - everything went OK, no errors
 - **412** - validation failed on some variable. More details are available in `$e->getMessages()`

# Handling the checkout process

When the order is created you should open an iframe with address provided by method `Stidner\Api::getCompleteUrl`. Example usage of the method is available below:

```php
$iframeUrl = $api->getCompleteUrl($order->getOrderId());
```

Then you load the iframe in you template.

```html
<iframe src="<?=$iframeUlr?>"></iframe>
```

The customer will see a site where he will be able to finish his payment. When the payment finishes, the iframe will be redirected to the confirmation page you provided when you created the order.
It was the 3th argument in Merchant object.

If the customer choose PayPal as payment method there will be one additional step. After the iframe redirects the users browser to the PayPal site and customer complete the purchase, the customer will be redirected to checkout url in your merchant.
In an action which handles this request in your store, you need to call `Stidner\Api::handleCheckout` method to redirect the customer's iframe to the finial step of the purchase.

```php
$api->handleCheckout($orderId);
```

This will finish execution of the code so make sure it is the last code in your action.

# Generating the SDK API documentation

You can generate the SDK API documentation using [phpDocumentator](https://github.com/phpDocumentor/phpDocumentor2). To generate the docs just type the command

    ./vendor/bin/phpdoc -d ./src/ -t docs

and then open with your web browser file ./docs/index.html
