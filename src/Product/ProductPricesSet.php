<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class ProductPricesSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($id): ?ProductStore
    {
        return $this->items[$id] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($productPrice) {
            return ProductPrice::fromJson($productPrice);
        }, $json));
    }

    private static function getKey(ProductPrice $productPrice): ?string
    {
        return (string) $productPrice->getPriceId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (ProductPrice $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(ProductPrice $productPrice, ProductPrice $otherProductPrice) : bool
    {
        return $productPrice->equals($otherProductPrice);
    }
}
