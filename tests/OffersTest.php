<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Thrive\Offer\BuyOneGetOneHalfOff;
use Thrive\Product;

/**
 * Unit tests for offer strategies.
 */
final class OffersTest extends TestCase
{
    public function test_bogo_half_off_applies_per_pair(): void
    {
        $offer = new BuyOneGetOneHalfOff('R01');
        $items = [
            new Product('R01', 'Red Widget', 32.95),
            new Product('R01', 'Red Widget', 32.95),
            new Product('B01', 'Blue Widget', 7.95),
        ];

        $discount = $offer->apply($items);

        $this->assertSame(16.48, $discount);
    }

    public function test_bogo_half_off_no_discount_if_less_than_two(): void
    {
        $offer = new BuyOneGetOneHalfOff('R01');
        $items = [
            new Product('R01', 'Red Widget', 32.95),
        ];

        $this->assertSame(0.0, $offer->apply($items));
    }
}


