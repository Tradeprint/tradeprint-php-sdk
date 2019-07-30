<?php


/**
 * Get the expected delivery datee
 * https://docs.sandbox.tradeprint.io/?version=latest#ca75104b-eb43-40f8-9205-109dc2297327
 */

use Tradeprint\TPAuthorizationException;
use Tradeprint\TradeprintSDK;

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $productService = $tradeprint->getProductService();

    $result = $productService->getExpectedDeliveryDate('PRD-CMHPUMSF', 250, 'Saver', 'Just Print',  [
        'Size' => '1/3 A4 (DL)',
        'Sides Printed' => 'Double Sided',
        'Sets' => '1',
        'Lamination' => 'Both Sides (Gloss)',
        'Paper Type' => '450gsm Art Board Silk Finish',
    ]);

    $res = $result->toArray();

    echo 'Expected delivery date: '.$res['formattedDate'];

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Error getting delivery date ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}
