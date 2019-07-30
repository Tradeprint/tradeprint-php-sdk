<?php

/**
 * Get an order by order reference
 * https://docs.sandbox.tradeprint.io/?version=latest#ca75104b-eb43-40f8-9205-109dc2297327
 */
try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $orderService = $tradeprint->getOrderService();

    $result = $orderService->getOrder('YOUR_ORDER_REFERENCE');

    $order = $result->toArray();

    print_r($order);
    echo 'Got order => '.print_r($order, true);

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Error getting order ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}