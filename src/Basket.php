<?php

declare(strict_types=1);

namespace Thrive;

use Thrive\Contracts\BasketInterface;
use Thrive\Contracts\DeliveryStrategyInterface;
use Thrive\Contracts\CalculateDiscountInterface;

/**
 * Basket aggregates products, applies offers, and adds delivery.
 */
final class Basket implements BasketInterface
{
    /** @var list<Product> */
    private array $items = [];

    /**
     * @param Catalog $catalog Catalog for lookup by code.
     * @param DeliveryStrategyInterface $delivery Delivery cost strategy.
     * @param list<CalculateDiscountInterface> $offers calculate discount strategies to apply.
     */
    public function __construct(
        private readonly Catalog $catalog,
        private readonly DeliveryStrategyInterface $delivery,
        /** @var list<CalculateDiscountInterface> */
        private readonly array $offers = []
    ) {
    }

    public function add(string $productCode): void
    {
        $this->items[] = $this->catalog->getProductByCode($productCode);
    }

    public function total(): float
    {
        $subtotal = 0.0;
        foreach ($this->items as $item) {
            $subtotal += $item->price;
        }

        $discount = 0.0;
        foreach ($this->offers as $offer) {
            $discount += $offer->apply($this->items);
        }

        $discounted = max(0.0, $subtotal - $discount);
        $delivery = $this->delivery->getCost($discounted);
        $total = $discounted + $delivery;

        return round($total, 2, PHP_ROUND_HALF_UP);
    }

    /**
     * @return list<Product>
     */
    public function items(): array
    {
        return $this->items;
    }
}


