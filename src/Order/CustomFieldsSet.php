<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class CustomFieldsSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($name): ?CustomFields
    {
        return $this->items[$name] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($item) {
            return CustomFields::fromJson($item);
        }, $json));
    }

    private static function getKey(CustomFields $customField): ?string
    {
        return (string) $customField->getName();
    }

    public function add(CustomFields $customField): self
    {
        $result = clone $this;
        $result->items[self::getKey($customField)] = $customField;
        return $result;
    }

    public function toJson(): array
    {
        return
            \array_map(function (CustomFields $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(CustomFields $item, CustomFields $otherItem) : bool
    {
        return $item->equals($otherItem);
    }
}
