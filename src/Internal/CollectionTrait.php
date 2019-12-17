<?php
declare(strict_types=1);
namespace SnowIO\OrderHiveDataModel\Internal;

trait CollectionTrait
{
    public static function create(): self
    {
        return new self;
    }

    public static function of(array $items): self
    {
        $collection = new self;
        $collection->items = $items;
        return $collection;
    }

    public function isEmpty()
    {
        return count($this->items) === 0;
    }

    public function getIterator(): \Iterator
    {
        foreach ($this->items as $item) {
            yield $item;
        }
    }

    public function equals($collection): bool
    {
        if (!$collection instanceof self) {
            return false;
        }

        if (count($this->items) !== count($collection->items)) {
            return false;
        }

        foreach ($collection as $itemInCollection) {
            if (!$this->contains($itemInCollection)) {
                return false;
            }
        }

        return true;
    }

    public function contains($item): bool
    {
        return $this->indexOf($item) >= 0;
    }

    public function indexOf($item): int
    {
        if ($item === null) {
            for ($i = 0; $i < count($this->items); $i++) {
                if ($this->items[$i] === null) {
                    return $i;
                }
            }
        } else {
            for ($i = 0; $i < count($this->items); $i++) {
                if (self::itemsAreEqual($this->items[$i], $item)) {
                    return $i;
                }
            }
        }
        return -1;
    }

    private $items = [];

    private function __construct()
    {

    }
}
