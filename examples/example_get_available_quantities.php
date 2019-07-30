<?php

/**
 * Get available quantities for a product combination
 */
try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $productService = $tradeprint->getProductService();

    $quantities = $productService->getAvailableQuantities('PRD-CMHPUMSF', 'Saver',  [
        'Size' => '1/3 A4 (DL)',
        'Sides Printed' => 'Double Sided',
        'Sets' => '1',
        'Lamination' => 'Both Sides (Gloss)',
        'Paper Type' => '450gsm Art Board Silk Finish',
    ]);

    print_r($quantities->toArray());

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Error trying to get available quantities: ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}