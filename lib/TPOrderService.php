<?php
namespace Tradeprint;


if(!class_exists('Tradeprint\TPOrderException'))
{
    class TPOrderService
    {
        private $_api;

        public function __construct($api)
        {
            $this->_api = $api;
        }

        /**
         * Create a new order
         * @param array $payload ,
         * @return array
         * @see https://docs.sandbox.tradeprint.io/?version=latest#7df5f1d2-2e24-43fd-894a-a2c3e306e7cb
         */
        public function createOrder($payload)
        {
            return $this->_api->post('orders', $payload);
        }

        /**
         * Get an order by order reference
         * @param string $orderReference - order reference when creating the order
         * @return array
         */
        public function getOrder($orderReference)
        {
            return $this->_api->get("orders/{$orderReference}");
        }

        /**
         * Fetch multiple orders by supplying an array of order references
         * @param array $orderReferences array of orderReferences
         * @return array
         */
        public function getOrders($orderReferences)
        {
            return $this->_api->post('orders/ordersStatus', ['orderReferences' => $orderReferences]);
        }

        /**
         * Validate an order, run it through validation
         * but do not save it
         * @see https://docs.sandbox.tradeprint.io/?version=latest#b1822b88-b0f1-4fb2-b94d-de717a2971b7
         * @param array $payload
         * @return mixed
         */
        public function validateOrder($payload)
        {
            return $this->_api->post('validate/orders', $payload);
        }

        /**
         * Update or replace artwork on an order
         * @param string $orderReference - The order reference
         * @param string $itemReference - The item referencee
         * @param array<string> $artworkUrls
         * @return array
         */
        public function putArtwork($orderReference, $itemReference, $artworkUrls)
        {
            return $this->_api->put("orders/{$orderReference}/orderItems/{$itemReference}/fileUrls", ['fileUrls' => $artworkUrls]);
        }

        /**
         * Cancel an order item
         * @param string $orderReference - the order reference of the order of where the item we want to cancel lives.
         * @param string $itemReference - the item reference to cancel
         * @return array
         */
        public function cancelOrderItem($orderReference, $itemReference)
        {
            return $this->_api->delete("orders/{$orderReference}/orderItems/{$itemReference}");
        }

        /**
         * Retry a paymeet that has failed
         * @param $orderReference - the order reference of the order to retry
         * @return mixed
         */
        public function retryFailedPayment($orderReference)
        {
            return $this->_api->post("orders/{$orderReference}/retryPayment", []);
        }
    }
}