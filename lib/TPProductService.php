<?php

namespace Tradeprint;

if (!class_exists('Tradeprint\TPProductService')) {

    class TPProductService
    {
        private $_api;

        public function __construct($api)
        {
            $this->_api = $api;
        }

        public function getExpectedDeliveryDate($productId, $quantity, $serviceLevel, $artworkService, $productionData, $deliveryAddress = null)
        {
            $payload = [
                'productId' => $productId,
                'quantity' => $quantity,
                'serviceLevel' => $serviceLevel,
                'artworkService' => $artworkService,
                'productionData' => $productionData,
            ];

            if (!empty($deliveryAddress)) {
                $payload['deliveryAddress'] = $deliveryAddress;
            }

            return $this->_api->post('products/expectedDeliveryDate', $payload);
        }

        /**
         * Request product attributes from TP api
         * @param null $productName - optional product name, or return all
         * @return array
         */
        public function requestProductAttributes($productName = null)
        {
            if (empty($productName)) {
                return $this->_api->get('products-v2/attributes-v2');
            } else {
                return $this->_api->get("products-v2/attributes-v2/${productName}");
            }
        }

        /**
         * Request single product price list
         * @param $productName - the name of the product to fetch the price list for
         * @param string $format - the format, csv or json
         * @param int $markup - applied markup on the prices 0 = none
         * @param null $fromDate - only return product updated after specified date as DD/MM/YYY
         * @return mixed
         */
        public function requestSingleProductPriceList($productName, $format = 'json', $markup = 0, $fromDate = null)
        {
            $payload = [
                'format' => $format,
                'markup' => $markup
            ];

            if (!empty($fromDate)) {
                $payload['fromDate'] = $fromDate;
            }
            return $this->_api->post("products-v2/{$productName}", $payload);
        }

        /**
         * Request multiple products price list by email
         * @param $email - The email address to send the extract to
         * @param string $format - the format, csv or json
         * @param int $markup - applied markup on the prices 0 = none
         * @param null $fromDate - only return product updated after specified date as DD/MM/YYY
         * @param $productNames - array of product names to select, if null all products will be returned
         * @return mixed
         */
        public function requestMultiProductPriceList($email, $format = 'json', $markup = 0, $fromDate = null, $productNames = null)
        {
            $payload = [
                'email' => $email,
                'format' => $format,
                'markup' => $markup
            ];

            if (!empty($fromDate)) {
                $payload['fromDate'] = $fromDate;
            }

            if (!empty($productNames)) {
                $payload['productNames'] = $productNames;
            }

            return $this->_api->post('products-v2', $payload);
        }

        /**
         * Gets the availablee quantities for a given product combination
         * @param string $productId - The product ID
         * @param string $serviceLevel - The service level
         * @param array $productionData - The productionData
         * @return mixed
         */
        public function getAvailableQuantities($productId, $serviceLevel, $productionData)
        {
            return $this->_api->post('products-v2/quantities-v2', ['productId' => $productId, 'serviceLevel' => $serviceLevel, 'productionData' => $productionData]);
        }

    }
}