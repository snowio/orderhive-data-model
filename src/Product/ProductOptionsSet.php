<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class ProductOptionsSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($name): ?ProductOption
    {
        return $this->items[$name] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($productOption) {
            return ProductOption::fromJson($productOption);
        }, $json));
    }

    private static function getKey(ProductOption $productOption): ?string
    {
        return (string) $productOption->getName();
    }

    public function toJson(): array
    {
        return
            \array_map(function (ProductOption $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(ProductOption $productOption, ProductOption $anotherProductOption) : bool
    {
        return $productOption->equals($anotherProductOption);
    }
}
