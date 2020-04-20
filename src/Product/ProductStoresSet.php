<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class ProductStoresSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($id): ?ProductStore
    {
        return $this->items[$id] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($productStore) {
            return ProductStore::fromJson($productStore);
        }, $json));
    }

    private static function getKey(ProductStore $productStore): ?string
    {
        return (string) $productStore->getStoreId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (ProductStore $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(ProductStore $productStore, ProductStore $otherProductStore) : bool
    {
        return $productStore->equals($otherProductStore);
    }
}
