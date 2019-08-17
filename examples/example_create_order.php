<?php

/**
 * Create a new order on the Tradeprint API
 * https://docs.sandbox.tradeprint.io/?version=latest#7df5f1d2-2e24-43fd-894a-a2c3e306e7cb
 * */
try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $orderService = $tradeprint->getOrderService();
    $result = $orderService->createOrder([
        'currency' => 'GBP',
        'orderItems' =>
            [
                [
                    'productId' => 'PRD-GGK8CQCM',
                    'fileUrls' =>
                        [
                            'https://s3-eu-west-1.amazonaws.com/filestacksupplytest/180MbFile.pdf',
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

    echo 'Order created: ref: '.$result['order']['orderReference'].' status: '.$result['order']['status'];

} catch (Tradeprint\TPAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Error creating order ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}