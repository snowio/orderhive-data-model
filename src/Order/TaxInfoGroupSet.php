<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class TaxInfoGroupSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($id): ?Item
    {
        return $this->items[$id] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($group) {
            return TaxInfoGroup::fromJson($group);
        }, $json));
    }

    private static function getKey(TaxInfoGroup $taxInfoGroup): ?string
    {
        return (string) $taxInfoGroup->getId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (TaxInfoGroup $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(TaxInfoGroup $group, TaxInfoGroup $otherGroup) : bool
    {
        return $group->equals($otherGroup);
    }
}
