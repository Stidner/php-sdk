<?php
/*
   Example for manually crafting the Stidner Checkout iframe using our SDK.
   Examples and documentation here is meant to be straightforward, to get you started quickly.

   For more examples, or if you want to craft requests without using our SDK, please
   read the full Stidner Order API documentation at http://developer.stidner.com/?php-sdk
*/


// Include the composer autoloads, or whatever way you prefer.
require_once 'vendor/autoload.php';

// Initiate an API handle with the login credentials.
$api_handle = new \Stidner\Api(USER_ID_NUMBER, 'API_KEY');


// Set the merchant URLs. First three are required (and can be http), last two are optional (and require https).
$merchant = new \Stidner\Model\Merchant();
$merchant->setTerms('http://example.com/terms_of_service.html')
    ->setCheckout('http://example.com/checkout.php')
    ->setConfirmation('http://example.com/confirmation.php')
    ->setPush(null)
    ->setDiscount(null);


// Optional: customize display elements on checkout.
// If you don't want to customize, you don't even need this initialized.
$options = new \Stidner\Model\Order\Options();
$options->setColorButton(null)
    ->setColorButtonText(null)
    ->setColorCheckbox(null)
    ->setColorCheckboxCheckmarks(null)
    ->setColorHeader(null)
    ->setColorLink(null)
    ->setColorBackground(null);

// Make billing address object.
$billingAddress = new \Stidner\Model\Address();
$billingAddress->setType('person')
    ->setBusinessName(null)// Do NOT use if setType("person")!
    ->setFirstName('Sven')
    ->setFamilyName('Andersson')
    ->setTitle('Mr')
    ->setAddressLine('Drottninggatan 75')
    ->setAddressLine2('LGH 1102')
    ->setPostalCode('46133')
    ->setCity('Trollhättan')
    ->setRegion('Västra Götalands Län')
    ->setPhone('+46851972000')
    ->setEmail('email@example.com')
    ->setCountryCode('SE');

// Add items. Each unique item in the order should have an unique ID or index.
$item[1] = new \Stidner\Model\Order\Item();
$item[1]->setType('digital')
    ->setArtno('160830')
    ->setSku('8000-660SE')
    ->setName('World of Warcraft: Legion')
    ->setDescription('Digital download')
    ->setWeight(null)
    ->setQuantity(1)
    ->setQuantityUnit('pcs')
    ->setUnitPrice(66000)
    ->setTaxRate(2500)
    ->calculateItemPrice()
    ->setImageUrl('https://example.com/game.jpg');

// One more unique item (again, using a unique variable or index).
$item[2] = new \Stidner\Model\Order\Item();
$item[2]->setType('physical')
    ->setArtno('220333')
    ->setSku('5205-250SE')
    ->setName('Golden shoes')
    ->setDescription('These shoes are made of gold')
    ->setWeight(1300)
    ->setQuantity(1)
    ->setQuantityUnit('pcs')
    ->setUnitPrice(105000)
    ->setTaxRate(2500)
    ->calculateItemPrice()
    ->setImageUrl('https://example.com/goldshoes.jpg');


// Bundle it all together now...
// Make the main order object, and add everything to it!
$order = new \Stidner\Model\Order();
$order->setMerchantReference1(null)
    ->setMerchantReference2(null)
    ->setPurchaseCountry('SE')
    ->setPurchaseCurrency('SEK')
    ->setLocale('sv_se')
    ->setBillingAddress($billingAddress)// Don't forget to add all the objects!
    ->addItem($item[1])
    ->addItem($item[2])
    ->calculateTotalPrices()
    ->setMerchantUrls($merchant)
    ->setFreeShipping(true)
    ->setShipmentCountries(['DK', 'SE'])
    ->setOptions($options);


// And send it off; remember to properly handle any unlikely exceptions!
try {
    $request = $api_handle->createOrder($order);
    $iframeUrl = $request->getIframeUrl();
    var_dump($request->getUpdatedDate());
    echo "<iframe src='$iframeUrl' width='75%' height='75%'></iframe>";
} catch (\Stidner\ApiException $e) {
    echo $e;
} catch (\Stidner\Api\ResponseException $e) {
    echo $e;
}
