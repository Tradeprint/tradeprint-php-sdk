<?php

/**
 * Retry a payment
 * See more at https://docs.sandbox.tradeprint.io/?version=latest#a4c34bda-065c-4d94-8125-db51304d7b7f
 */

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $orderService = $tradeprint->getOrderService();

    $cancellationResult = $orderService->retryFailedPayment('ORDER_REFERENCE');

    echo 'Payment retry successful';

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Payment retry failed ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}