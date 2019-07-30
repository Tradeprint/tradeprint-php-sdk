<?php

/**
 * Upload or replace artwork
 * https://docs.sandbox.tradeprint.io/?version=latest#03d1f33a-53d2-43f0-b45a-8b44f600a270
 */

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $orderService = $tradeprint->getOrderService();
    $result = $orderService->putArtwork('YOUR_ORDER_REFERENCE', 'YOUR_ITEM_REFERENCE', ['https://yourartworkurlhere']);

    print_r($result->toArray());

    echo 'Artwork replaced successfully';

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Error updating artwork: ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}