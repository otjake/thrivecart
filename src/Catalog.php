<?php

declare(strict_types=1);

namespace Thrive;

use InvalidArgumentException;

/**
 * In-memory catalog handles product management and lookup.
 */
final class Catalog
{
    /** @var array<string, Product> */
    private array $products = [];

    /**
     * Add a product to the catalog.
     *
     * @param Product $product Product to add.
     */
    public function addProduct(Product $product): void
    {
        $this->products[$product->code] = $product;
    }

    /**
     * Get a product by code.
     *
     * @param string $productCode Product code.
     *
     * @return Product Product matching the code.
     *
     * @throws InvalidArgumentException If product not found.
     */
    public function getProductByCode(string $productCode): Product
    {
        if (!isset($this->products[$productCode])) {
            throw new InvalidArgumentException("Unknown product code: {$productCode}");
        }

        return $this->products[$productCode];
    }

    /**
     * Get all products.
     *
     * @return array<string, Product> Map of product code to product.
     */
    public function allProducts(): array
    {
        return $this->products;
    }
}


