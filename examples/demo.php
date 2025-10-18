<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Thrive\Basket;
use Thrive\Catalog;
use Thrive\Delivery\BasicDeliveryStrategy;
use Thrive\Offer\BuyOneGetOneHalfOff;
use Thrive\Product;

function makeCatalog(): Catalog {
    $catalog = new Catalog();
    $catalog->addProduct(new Product('R01', 'Red Widget', 32.95));
    $catalog->addProduct(new Product('G01', 'Green Widget', 24.95));
    $catalog->addProduct(new Product('B01', 'Blue Widget', 7.95));
    return $catalog;
}

function makeBasket(): Basket {
    return new Basket(
        makeCatalog(),
        new BasicDeliveryStrategy(),
        [new BuyOneGetOneHalfOff('R01')]
    );
}

// Scenarios from the brief
$cases = [
    ['B01', 'G01'],
    ['R01', 'R01'],
    ['R01', 'G01'],
    ['B01', 'B01', 'R01', 'R01', 'R01'],
];

foreach ($cases as $items) {
    $basket = makeBasket();
    foreach ($items as $code) {
        $basket->add($code);
    }
    echo implode(', ', $items) . ' => ' . number_format($basket->total(), 2) . PHP_EOL;
}


