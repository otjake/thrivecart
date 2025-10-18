<?php

declare(strict_types=1);

namespace Thrive\Contracts;

use Thrive\Product;

/**
 * Interface for a shopping basket.
 */
interface BasketInterface
{
    /**
     * Use product code to add a product to the basket.
     *
     * @param string $productCode Product code as defined in the catalog.
     */
    public function add(string $productCode): void;

    /**
     * Calculate the total price of the basket including offers and delivery.
     *
     * @return float Total price rounded to 2 decimal places.
     */
    public function total(): float;

    /**
     * Get current items in the basket.
     *
     * @return list<Product> Items currently in the basket.
     */
    public function items(): array;
}


