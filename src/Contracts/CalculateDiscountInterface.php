<?php

declare(strict_types=1);

namespace Thrive\Contracts;

use Thrive\Product;

/**
 * Strategy for computing discount amount.
 */
interface CalculateDiscountInterface
{
    /**
     * Calculate the discount to apply for the provided items.
     *
     * @param list<Product> $items Items in the basket.
     *
     * @return float Discount amount (non-negative).
     */
    public function apply(array $items): float;
}


