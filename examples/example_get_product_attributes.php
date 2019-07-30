<?php

$tradeprint = new Tradeprint\TradeprintSDK('qa', 'dkwuBshYhsg27sxhd29j36hv7z72jd72h6zUi8', 'sandbox');
$productService = $tradeprint->getProductService();


// Getting attributes for ALL products
$result = $productService->requestProductAttributes();
print_r($result->toArray());

// Getting attributes for a single product
$result = $productService->requestProductAttributes('Flyers');

print_r($result->toArray());


