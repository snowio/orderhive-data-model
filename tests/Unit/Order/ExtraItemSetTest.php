<?php


namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\ExtraItem;
use SnowIO\OrderHiveDataModel\Order\ExtraItemSet;
use SnowIO\OrderHiveDataModel\OrderHiveDataException;

class ExtraItemSetTest extends TestCase
{
    public function testItemSetToJson()
    {
        $itemSet = ExtraItemSet::of([
            ExtraItem::of('Shipping & Handling')
                ->withPrice(15.0)
                ->withQuantityOrdered(1)
                ->withRowTotal(15)
                ->withUpdateType('ADD')
                ->withType('SHIPPING_COST')
        ]);

        self::assertEquals([
                $this->getSampleData('Shipping & Handling')
        ], $itemSet->toJson());
    }

    public function testInvalidSetItemSetTwiceInOf()
    {
        $this->expectException(OrderHiveDataException::class);

        ExtraItemSet::of([
            ExtraItem::of(1, 1),
            ExtraItem::of(1, 1)
        ]);
    }

    public function testInvalidItemSetTwiceInFromJson()
    {
        $this->expectException(OrderHiveDataException::class);

        ExtraItemSet::fromJson([
            ExtraItem::of('a')->toJson(),
            ExtraItem::of('a')->toJson(),
        ]);
    }

    public function testItemSetFromJson()
    {
        $data = [
            $this->getSampleData('a'),
            $this->getSampleData('b')
        ];
        $itemSet = ExtraItemSet::fromJson($data);

        self::assertSame(2, $itemSet->count());
        self::assertEquals($data, $itemSet->toJson());
    }

    public function testDefaultValues()
    {
        $itemSet = ExtraItemSet::of([
            ExtraItem::of('a')
        ]);

        self::assertEquals([
            [
                'name' => 'a',
                'price' => null,
                'quantity_ordered' => null,
                'row_total' => null,
                'tax_info' => null,
                'tax_percent' => null,
                'tax_value' => null,
                'update_type' => null,
                'type' => null,
            ]
        ], $itemSet->toJson());
    }

    public function testItemTwice()
    {
        $this->expectException(OrderHiveDataException::class);

        ExtraItemSet::of([
            ExtraItem::of('a'),
            ExtraItem::of('a')
        ]);
    }

    private function getSampleData($name='Shipping & Handling')
    {
        return [
            "name" => $name,
            "price" => 15.0,
            "quantity_ordered" => 1,
            "row_total" => 15.0,
            "tax_info" => null,
            "tax_percent" => null,
            "tax_value" => null,
            "update_type" => "ADD",
            "type" => "SHIPPING_COST"
        ];
    }
}
