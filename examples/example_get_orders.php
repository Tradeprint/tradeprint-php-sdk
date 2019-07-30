<?php

/**
 * Get orders by order references
 * https://docs.sandbox.tradeprint.io/?version=latest#06cc541c-cd0e-48dc-864a-3d32c6cf173f
 */

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $orderService = $tradeprint->getOrderService();

    $result = $orderService->getOrders(['ORDER_REFERENCE_ONE', 'ORDER_REFERENCE_TWO']);

    $orders = $result->toArray();

    print_r($orders);

    foreach($orders as $order) {
        // Do something
    }

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Error fetching orders ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}