<?php

/**
 * Request a single product price list
 * https://docs.sandbox.tradeprint.io/?version=latest#80cd6377-af47-4ace-8e26-cff1884b1acf
 */

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $productService = $tradeprint->getProductService();


    // EXAMPLE 1: Request as json
    $result = $productService->requestSingleProductPriceList('Standard BC')
        ->toArray();

    if($result['productsAvailable']) {
        $url = $result['url'];
        echo 'Products available at '.$url;
    } else {
        echo 'No products available';
    }

    // EXAMPLE 2: Request as csv
    $result = $productService->requestSingleProductPriceList('Standard BC', 'csv')
        ->toArray();

    if($result['productsAvailable']) {
        $url = $result['url'];
        echo 'Products available at '.$url;
    } else {
        echo 'No products available';
    }

    // EXAMPLE 3: Request as json with markup 10%
    $result = $productService->requestSingleProductPriceList('Standard BC', 'json', 10)
        ->toArray();

    if($result['productsAvailable']) {
        $url = $result['url'];
        echo 'Products available at '.$url;
    } else {
        echo 'No products available';
    }

    // EXAMPLE 4: Request with from date
    $result = $productService->requestSingleProductPriceList('Standard BC', 'json', 0, '10/10/2015')
        ->toArray();

    if($result['productsAvailable']) {
        $url = $result['url'];
        echo 'Products available at '.$url;
    } else {
        echo 'No products available';
    }

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Unable to request price list ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}