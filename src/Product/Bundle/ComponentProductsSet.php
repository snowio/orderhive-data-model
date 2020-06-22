<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product\Bundle;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class ComponentProductsSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($id): ?ComponentProduct
    {
        return $this->items[$id] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($productStore) {
            return ComponentProduct::fromJson($productStore);
        }, $json));
    }

    private static function getKey(ComponentProduct $productStore): ?string
    {
        return (string) $productStore->getProductId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (ComponentProduct $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(ComponentProduct $productStore, ComponentProduct $otherComponentProduct) : bool
    {
        return $productStore->equals($otherComponentProduct);
    }
}
