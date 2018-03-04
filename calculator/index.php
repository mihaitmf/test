<?php
use Calculator\Calculator;
use Calculator\Item;

require_once dirname(__DIR__) . "/externals/autoload.php";

if (php_sapi_name() !== 'cli') {
    echo "Please run this file from CLI\n";
    exit;
}

$items = [];
$state = readline("Enter state: ");
$itemsNo = readline("Enter the number of items: ");

for ($i = 0; $i < $itemsNo; $i++) {
    $quantity = readline("Enter quantity for item " . ($i+1) . ": ");
    $price = readline("Enter price for item " . ($i+1) . ": ");

    $items[] = new Item($quantity, $price);
}

$calculator = new Calculator();
$totalPrice = $calculator->calculateTotalPrice($items, $state);

printf("Total Price = %.2f\n", $totalPrice);


