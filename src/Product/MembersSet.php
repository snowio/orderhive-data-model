<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class MembersSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($sku): ?MemberProduct
    {
        return $this->items[$sku] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($member) {
            return MemberProduct::fromJson($member);
        }, $json));
    }

    private static function getKey(MemberProduct $member): ?string
    {
        return (string) $member->getSku();
    }

    public function toJson(): array
    {
        return
            \array_map(function (MemberProduct $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(MemberProduct $member, MemberProduct $anotherMember) : bool
    {
        return $member->equals($anotherMember);
    }
}
