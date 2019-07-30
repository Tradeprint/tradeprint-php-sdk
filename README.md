# Tradeprint PHP SDK

[![CircleCI](https://circleci.com/bb/tradeprintweb/tradeprint-php-sdk.svg?style=svg&circle-token=0eb6544fc4f5f3faa81a823951a454fdeda6f87e)](https://circleci.com/bb/tradeprintweb/tradeprint-php-sdk)

## Introduction

Tradeprint PHP SDK allows you to easily add your print on demand functionality to your app or website within minutes! Print Postcards, Business Cards, Posters, Stickers on a roll, T-Shirts, etc. Our Tradeprint PHP SDK industry standardised documentation and instructions are easy to follow and would take a software engineer no longer than a few days to complete the full integration.

Our Sandbox print API environment allows you to interact with the API endpoints through the Tradeprint PHP SDK.

As the API is created by our in-house team, we provide support to ensure it is set up and running smoothly. Once up and running, we don’t anticipate a need for further maintenance from our side. However, we do expect some work to maintain your product catalogue. This work includes adding, removing and editing products and can completed manually by your team, or parts can be automated.
## Requirements

PHP >= 5.60

You will also require credentials for the Tradeprint API, if you do not already have these then please visit https://www.tradeprint.co.uk/tradeprint-api
## Installation
Via composer
```
composer require tradeprint/tradeprint-php-sdk
```

Manually (For WordPress, Magento etc...) 
1. Download the SDK 
2. Include it in your project directory
3. Import it as below
```php
require_once('path-to-tradeprint-sdk/init.php');
```

## Usage

```php

try {
    $tradeprint = new Tradeprint\TradeprintSDK('YOUR_TP_USERNAME', 'YOUR_TP_PASSWORD', 'sandbox');
    $orderService = $tradeprint->getOrderService();

    $result = $orderService->getOrder('YOUR_ORDER_REFERENCE');

    $order = $result->toArray();
    echo 'Got order => '.print_r($order, true);

} catch (Tradeprint\TpAuthorizationException $e) {
    echo 'Invalid username or password';
} catch (Tradeprint\TPException $e) {
    echo 'Error getting order ' . $e->getMessage() . PHP_EOL;
    print_r($e->getDetails());
}   
```
Discover more with our detailed [examples](examples)
