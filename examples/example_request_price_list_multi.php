<?php

/**
 * Request multiple products
 * https://docs.sandbox.tradeprint.io/?version=latest#2206363e-3668-4c2e-b1ec-e9523416916a
 */

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $productService = $tradeprint->getProductService();

    // EXAMPLE 1: Request price list as json
    $simpleAsJson = $productService->requestMultiProductPriceList('your.email@address.com');
    echo 'Price list as json is on the way to your email address' .PHP_EOL;

    // EXAMPLE 2: Request price list as csv
    $csvType = $productService->requestMultiProductPriceList('your.email@address.com', 'csv');
    echo 'Price list as csv is on the way to your email address' .PHP_EOL;

    // EXAMPLE 3: Request price list as json with 10% markup
    $markupType = $productService->requestMultiProductPriceList('your.email@address.com', 'json', 10);
    echo 'Price list as json is on the way to your email address' .PHP_EOL;

    // EXAMPLE 4: Request price list as json with a specified fromDate
    $fromDate = $productService->requestMultiProductPriceList('your.email@address.com', 'json', null,'21/04/2017');

    // EXAMPLE 5: Request price list as json with specific products only
    $specificProducts = $productService->requestMultiProductPriceList('your.email@address.com', 'json', null,null, ['Flyers', 'Standard BC']);
    echo 'Price list as json is on the way to your email address' .PHP_EOL;

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Unable to request price list ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}