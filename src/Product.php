<?php

declare(strict_types=1);

namespace Thrive;

/**
 * Value object representing a product in the catalog.
 */
final class Product
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly float $price
    ) {
    }
}


