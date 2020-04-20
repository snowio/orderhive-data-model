<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class CustomFieldsSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($id): ?CustomField
    {
        return $this->items[$id] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($customField) {
            return CustomField::fromJson($customField);
        }, $json));
    }

    private static function getKey(CustomField $customField): ?string
    {
        return (string) $customField->getId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (CustomField $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(CustomField $customField, CustomField $anotherCustomField) : bool
    {
        return $customField->equals($anotherCustomField);
    }
}
