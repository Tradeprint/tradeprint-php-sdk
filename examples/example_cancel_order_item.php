<?php
/**
 * Cancels an order item
 * https://docs.sandbox.tradeprint.io/?version=latest#4dc388f6-26b4-4141-b71e-0885c3532dd0
 */

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $orderService = $tradeprint->getOrderService();

    $cancellationResult = $orderService->cancelOrderItem('ORDER_REFERENCE', 'ITEM_REFERENCE');

    print_r($cancellationResult);

    echo 'Item deleted successfully';

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Unable to cancel item ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}