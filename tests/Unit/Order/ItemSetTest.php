<?php


namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\Item;
use SnowIO\OrderHiveDataModel\Order\ItemSet;
use SnowIO\OrderHiveDataModel\OrderHiveDataException;

class ItemSetTest extends TestCase
{
    public function testItemSetToJson()
    {
        $itemSet = ItemSet::of([
            Item::of(1, 99)
                ->withName('name')
                ->withSku('sku')
                ->withPrice(1.99)
                ->withBarcode('barcode')
                ->withAsinNumber('asinnumber')
        ]);

        self::assertEquals([
                $this->getSampleData(1)
        ], $itemSet->toJson());
    }

    public function testInvalidSetItemSetTwiceInOf()
    {
        $this->expectException(OrderHiveDataException::class);

        ItemSet::of([
            Item::of(1, 1),
            Item::of(1, 1)
        ]);
    }

    public function testInvalidItemSetTwiceInFromJson()
    {
        $this->expectException(OrderHiveDataException::class);

        ItemSet::fromJson([
            Item::of(1, 1)->toJson(),
            Item::of(1, 2)->toJson(),
        ]);
    }

    public function testItemSetFromJson()
    {
        $data = [
            $this->getSampleData(1),
            $this->getSampleData(2)
        ];
        $itemSet = ItemSet::fromJson($data);

        self::assertSame(2, $itemSet->count());
        self::assertEquals($data, $itemSet->toJson());
    }

    public function testDefaultValues()
    {
        $itemSet = ItemSet::of([
            Item::of(1, 2)
        ]);

        self::assertEquals([
            [
                'item_id' => 1,
                'quantity_ordered' => 2,
                'asin_number' => null,
                'channel_primary_id' => null,
                'reference_number' => null,
                'channel_secondary_id' => null,
                'components' => null,
                'barcode' => null,
                'discount_percent' => null,
                'discount_type' => null,
                'discount_value' => null,
                'id' => null,
                'item_warehouse' => null,
                'meta_data' => null,
                'name' => null,
                'note' => null,
                'price' => null,
                'product_image' => [
                    'id' => null,
                    'default_image' => null,
                    'thumbnail' => null,
                    'url' => null,
                ],
                'quantity_invoiced' => null,
                'row_total' => null,
                'sku' => null,
                'tax_info' => [
                    'id' => null,
                    'tax_rate' => null,
                    'groups' => [],
                ],
                'tax_percent' => null,
                'tax_value' => null,
                'update_type' => null,
                'weight' => null,
                'weight_unit' => null,
            ]
        ], $itemSet->toJson());
    }

    public function testItemTwice()
    {
        $this->expectException(OrderHiveDataException::class);

        ItemSet::of([
            Item::of(2, 1),
            Item::of(2, 1)
        ]);
    }

    public function testGetShouldUseOrderItemIdAsKey()
    {
        $itemSet = ItemSet::of([
            Item::of(1, 1)
        ]);
        self::assertInstanceOf(Item::class, $itemSet->get(1));
        self::assertNull($itemSet->get(0));
    }

    public function testEquality()
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
            'channel_primary_id' => null,
            'reference_number' => null,
            'channel_secondary_id' => null,
            'components' => null,
            'discount_percent' => null,
            'discount_type' => null,
            'discount_value' => null,
            'id' => null,
            'item_warehouse' => null,
            'meta_data' => null,
            'note' => null,
            'product_image' => [
                'id' => null,
                'default_image' => null,
                'thumbnail' => null,
                'url' => null,
            ],
            'quantity_invoiced' => null,
            'row_total' => null,
            'tax_info' => [
                'id' => null,
                'tax_rate' => null,
                'groups' => [],
            ],
            'tax_percent' => null,
            'tax_value' => null,
            'update_type' => null,
            'weight' => null,
            'weight_unit' => null,
        ];
    }
}
