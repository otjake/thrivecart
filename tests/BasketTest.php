<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Thrive\Basket;
use Thrive\Catalog;
use Thrive\Delivery\BasicDeliveryStrategy;
use Thrive\Offer\BuyOneGetOneHalfOff;
use Thrive\Product;

/**
 * Integration tests for basket totals.
 */
final class BasketTest extends TestCase
{
    private function createCatalog(): Catalog
    {
        $catalog = new Catalog();
        $catalog->addProduct(new Product('R01', 'Red Widget', 32.95));
        $catalog->addProduct(new Product('G01', 'Green Widget', 24.95));
        $catalog->addProduct(new Product('B01', 'Blue Widget', 7.95));

        return $catalog;
    }

    private function createBasket(): Basket
    {
        return new Basket(
            $this->createCatalog(),
            new BasicDeliveryStrategy(),
            [new BuyOneGetOneHalfOff('R01')]
        );
    }

    public function test_example_basket_b01_g01_totals_37_85(): void
    {
        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('G01');

        $this->assertSame(37.85, $basket->total());
    }

    public function test_example_basket_r01_r01_totals_54_37(): void
    {
        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('R01');

        $this->assertSame(54.37, $basket->total());
    }

    public function test_example_basket_r01_g01_totals_60_85(): void
    {
        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('G01');

        $this->assertSame(60.85, $basket->total());
    }

    public function test_example_basket_b01_b01_r01_r01_r01_totals_98_27(): void
    {
        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');

        $this->assertSame(98.27, $basket->total());
    }
}


