# Thrive Basket

Production-style implementation of a simple basket with delivery and offers, designed for thrive cart interview.

## Requirements
- PHP 8.2+
- Composer

## Install
```bash
composer install
```

## Run tests
```bash
composer test
```

## Quick run (CLI demo)
```bash
php examples/demo.php
```
Expected output:
```
B01, G01 => 37.85
R01, R01 => 54.37
R01, G01 => 60.85
B01, B01, R01, R01, R01 => 98.27
```

## Static analysis
```bash
composer stan
```

## Example usage (from tests)
- Basket with `B01` and `G01` totals to `37.85`.
- Delivery:
  - Subtotal < 50 => 4.95
  - Subtotal < 90 => 2.95
  - Otherwise => 0.00
- Offer:
  - Buy one get one half off for `R01` pairs.

Design: Strategy pattern for delivery and offers, dependency injection via constructor, PSR-4 autoloading, PHPUnit, PHPStan.

## Assumptions
- Rounding: totals are rounded to 2 decimals with HALF_UP; the BOGO discount is rounded to cents before delivery is applied to avoid discripancies for payment processor and reconciliation efforts.
- Money type: prices are represented as floats for simplicity; in production prefer integer minor units (cents) or a money library.
- Offer stacking: all offers' discounts are summed; BOGO applies per complete pair of `R01`. Any leftover item is full price.
- Delivery order: delivery is computed on the discounted subtotal (after offers).
- Delivery tiers: `< $50 => 4.95`, `< $90 => 2.95`, `>= $90 => 0.00`.
- Catalog: in-memory, product codes are unique and required; unknown codes throw `InvalidArgumentException`.
- Items: the basket stores individual items (no quantity collapsing); order is not significant for pricing.
- Typing: files use `declare(strict_types=1);` and classes are `final` where appropriate; PSR-4 autoloading is configured under the `Thrive\\` namespace.
