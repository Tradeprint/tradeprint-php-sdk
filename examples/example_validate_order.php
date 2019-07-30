<?php

/**
 * Validate an order
 * See more at https://docs.sandbox.tradeprint.io/?version=latest#b1822b88-b0f1-4fb2-b94d-de717a2971b7
 */

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $orderService = $tradeprint->getOrderService();
    $result = $orderService->validateOrder([
        'currency' => 'GBP',
        'orderItems' =>
            [
                0 =>
                    [
                        'productId' => 'PRD-GGK8CQCM',
                        'fileUrls' =>
                            [
                                0 => 'https://s3-eu-west-1.amazonaws.com/filestacksupplytest/180MbFile.pdf',
                            ],
                        'withoutArtwork' => false,
                        'quantity' => 500,
                        'serviceLevel' => 'Standard',
                        'productionData' =>
                            [
                                'Lamination' => 'None',
                                'Paper Type' => '400gsm Art Board Silk Finish',
                                'Round Corners' => 'Yes',
                                'Sets' => '1',
                                'Sides Printed' => 'Double Sided',
                                'Spot Uv' => 'None',
                            ],
                        'partnerContactDetails' =>
                            [
                                'firstName' => 'John',
                                'lastName' => 'Doe',
                                'email' => 'john@doe.com',
                                'contactPhone' => '07655 568 134',
                                'companyName' => 'Tradeprint Distribution Ltd.',
                            ],
                        'deliveryAddress' =>
                            [
                                'companyName' => 'Doe Distribution',
                                'firstName' => 'John',
                                'lastName' => 'Doe',
                                'add1' => '1 Magic street',
                                'add2' => 'string',
                                'town' => 'London',
                                'postcode' => 'E15 4EA',
                                'country' => 'GB',
                            ],
                        'extraData' =>
                            [
                                'description' => 'Order description',
                                'comments' => 'Please ensure not to trim into text',
                                'partnerItemId' => 'doe_12345',
                                'merchandisingProductName' => 'Comp Slip',
                                'referenceLabel' => 'For Sandeep new shop',
                                'purchaseOrder' => '12345679',
                            ],
                    ],
            ],
        'billingAddress' =>
            [
                'firstName' => 'Steeve',
                'lastName' => 'Roucaute',
                'add1' => 'Tradeprint Distribution Ltd',
                'add2' => '2 FULTON ROAD',
                'postcode' => 'DD2 4SW',
                'town' => 'DUNDEE',
                'country' => 'GB',
                'companyName' => 'TRADEPRINT DISTRIBUTION LTD',
                'email' => 'steeve@tradeprint.co.uk',
                'contactPhone' => '0123456879',
                'mobile' => '0751424242',
            ]])->toArray();

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Error validating order ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}