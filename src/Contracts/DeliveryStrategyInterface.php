<?php

declare(strict_types=1);

namespace Thrive\Contracts;

/**
 * Strategy for calculating delivery cost.
 */
interface DeliveryStrategyInterface
{
    /**
     * Compute delivery cost based on the given subtotal.
     *
     * @param float $subtotal Subtotal after discounts.
     *
     * @return float Delivery cost.
     */
    public function getCost(float $subtotal): float;
}


