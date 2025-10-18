<?php

declare(strict_types=1);

namespace Thrive\Delivery;

use Thrive\Contracts\DeliveryStrategyInterface;

/**
 * Delivery pricing with tiered thresholds.
 */
final class BasicDeliveryStrategy implements DeliveryStrategyInterface
{
    public function getCost(float $subtotal): float
    {
        return match (true) {
            $subtotal < 50.0 => 4.95,
            $subtotal < 90.0 => 2.95,
            default => 0.0,
        };
    }
}


