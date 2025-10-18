<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Thrive\Delivery\BasicDeliveryStrategy;

/**
 * Unit tests for delivery strategy.
 */
final class DeliveryTest extends TestCase
{
    public function test_tier_under_50(): void
    {
        $delivery = new BasicDeliveryStrategy();
        $this->assertSame(4.95, $delivery->getCost(49.99));
    }

    public function test_tier_under_90(): void
    {
        $delivery = new BasicDeliveryStrategy();
        $this->assertSame(2.95, $delivery->getCost(50.00));
    }

    public function test_free_at_90_or_above(): void
    {
        $delivery = new BasicDeliveryStrategy();
        $this->assertSame(0.0, $delivery->getCost(90.00));
    }
}


