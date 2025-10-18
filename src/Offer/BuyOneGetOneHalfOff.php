<?php

declare(strict_types=1);

namespace Thrive\Offer;

use Thrive\Contracts\CalculateDiscountInterface;
use Thrive\Product;

/**
 * Applies a 50% discount for each pair of the target product code.
 */
final class BuyOneGetOneHalfOff implements CalculateDiscountInterface
{
    public function __construct(
        private readonly string $targetCode = 'R01'
    ) {
    }

    /**
     * @param list<Product> $items
     */
    public function apply(array $items): float
    {
        $targetItemCount = 0;
        $unitPrice = null;

        foreach ($items as $item) {
            if ($item->code === $this->targetCode) {
                $targetItemCount++;
                $unitPrice ??= $item->price;
            }
        }

        if ($unitPrice === null || $targetItemCount < 2) {
            return 0.0;
        }

        $pairs = intdiv($targetItemCount, 2);
        $discount = $pairs * ($unitPrice * 0.5);
        $roundedDiscount = round($discount, 2, PHP_ROUND_HALF_UP);

        return max(0.0, $roundedDiscount);
    }
}


