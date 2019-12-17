<?php


namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\Item;
use SnowIO\OrderHiveDataModel\Order\ItemSet;

class ItemSetTest extends TestCase
{
    public function XestItemSetToJson()
    {
        $itemSet = ItemSet::of([
            Item::of(1, 99)
                ->withName('name')
                ->withSku('sku')
                ->withPrice(1.99)
                ->withBarcode('barcode')
                ->withAsinNumber('asinnumber')

            // @todo a few more properties to map
        ]);

        self::assertEquals([
                $this->getSampleData(1)
        ], $itemSet->toJson());
    }

    /**
     * @expectedException \SnowIO\OrderHiveDataModel\OrderHiveDataException
     * @expectedMessage Cannot set Item with same stockNumber
     */
    public function XestInvalidSetItemSetTwiceInOf()
    {
        ItemSet::of([
            Item::of(1, 1),
            Item::of(1, 1)
        ]);
    }

    /**
     * @expectedException \SnowIO\OrderHiveDataModel\OrderHiveDataException
     * @expectedMessage Cannot set OrderCredit with same stockNumber
     */
    public function XestInvalidItemSetTwiceInFromJson()
    {
        ItemSet::fromJson([
            [
                Item::of(1, 1)->toJson(),
                Item::of(1, 2)->toJson(),
            ]
        ]);
    }

    public function XestItemSetFromJson()
    {
        $data = [
            $this->getSampleData(1),
            $this->getSampleData(2)
        ];
        $itemSet = ItemSet::fromJson($data);

        self::assertSame(2, $itemSet->count());
        self::assertEquals($data, $itemSet->toJson());
    }

    public function XestDefaultValues()
    {
        $itemSet = ItemSet::of([
            Item::of(1, 2)
        ]);

        self::assertEquals([
            [
                'item_id' => 1,
                'asin_number' => null,
                'barcode' => null,
                'note' => null,
                'price' => 0,
                'quantity_ordered' => 2,
            ]
        ], $itemSet->toJson());
    }

    /**
     * @expectedException \SnowIO\OrderHiveDataModel\OrderHiveDataException
     * @expectedMessage Cannot set Item with same orderItemId
     */
    public function XestItemTwice()
    {
        ItemSet::of([
            Item::of(2, 1),
            Item::of(2, 1)
        ]);
    }

    public function XestGetShouldUseOrderItemIdAsKey()
    {
        $itemSet = ItemSet::of([
            Item::of(1, 1)
        ]);
        self::assertInstanceOf(Item::class, $itemSet->get(1));
        self::assertNull($itemSet->get(0));
    }

    public function XestEquality()
    {
        $itemSet = ItemSet::of([
            Item::of(1, 0),
            Item::of(2, 0),
            Item::of(3, 0),
        ]);
        $sameSet = ItemSet::of([
            Item::of(1, 0),
            Item::of(2, 0),
            Item::of(3, 0),
        ]);
        $notSameSet = ItemSet::of([
            Item::of(1, 1),
            Item::of(2, 0),
            Item::of(3, 2),
        ]);
        self::assertTrue($itemSet->equals($sameSet));
        self::assertFalse($itemSet->equals($notSameSet));
    }

    private function getSampleData($itemId)
    {
        return [
            'item_id' => $itemId,
            'asin_number' => 'asinnumber',
            'barcode' => 'barcode',
            'price' => 1.99,
            'sku' => 'sku',
            'name' => 'name',
            'quantity_ordered' => 99,

        ];
    }
}
