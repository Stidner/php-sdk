<?php
/*
   Example for fetching the status of an order using our SDK.
   Examples and documentation here is meant to be straightforward, to get you started quickly.

   For more examples, or if you want to craft requests without using our SDK, please
   read the full Stidner Order API documentation at http://developer.stidner.com/?php-sdk
*/


// Include the composer autoloads, or whatever way you prefer.
require_once 'vendor/autoload.php';

// Initiate an API handle with the login credentials.
$api_handle = new \Stidner\Api(USER_ID_NUMBER, 'API_KEY');

// And send it off; remember to properly handle any unlikely exceptions!
try {
    $request = $api_handle->getOrder('ORDER_REFERENCE_ID');
    $orderStatus = $request->getStatus();

    switch ($orderStatus) {
        case 'purchase_incomplete':
            echo 'Purchase is incomplete.';
            break;

        case 'purchase_complete':
            echo 'Purchase is complete!';
            break;

        case 'purchase_refunded':
            echo 'Purchase was refunded.';
            break;

        default:
            echo 'Unknown response.';
            break;
    }
} catch (\Stidner\ApiException $e) {
    echo $e;
} catch (\Stidner\Api\ResponseException $e) {
    echo $e;
}
