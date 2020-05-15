<?php

namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\CustomFieldsSet;
use SnowIO\OrderHiveDataModel\Order\CustomFields;
use SnowIO\OrderHiveDataModel\OrderHiveDataException;

class CustomFieldsTest extends TestCase
{
    public function testCustomFieldsSetToJson()
    {
        $customFieldSet = CustomFieldsSet::of([
            CustomFields::of('field name', 'NUMBER', '123')
        ]);

        self::assertEquals([
                $this->getSampleData('field name')
        ], $customFieldSet->toJson());
    }

    public function testInvalidSetItemSetTwiceInOf()
    {
        $this->expectException(OrderHiveDataException::class);

        CustomFieldsSet::of([
            CustomFields::of('a', 'TEXT', '123'),
            CustomFields::of('a', 'TEXT', '123')
        ]);
    }

    public function testInvalidCustomFieldType()
    {
        $this->expectException(OrderHiveDataException::class);

        CustomFieldsSet::of([
            CustomFields::of('a', 'INVALID', '123')
        ]);
    }

    public function testInvalidItemSetTwiceInFromJson()
    {
        $this->expectException(OrderHiveDataException::class);

        CustomFieldsSet::fromJson([
            CustomFields::of('a', 'TEXT', '123')->toJson(),
            CustomFields::of('a', 'TEXT', '123')->toJson(),
        ]);
    }

    public function testItemSetFromJson()
    {
        $data = [
            $this->getSampleData('a'),
            $this->getSampleData('b')
        ];
        $customFieldSet = CustomFieldsSet::fromJson($data);

        self::assertSame(2, $customFieldSet->count());
        self::assertEquals($data, $customFieldSet->toJson());
    }

    public function testDefaultValues()
    {
        $customFieldSet = CustomFieldsSet::of([
            CustomFields::of('a', 'TEXT', '123')
        ]);

        self::assertEquals([
            [
                'name' => 'a',
                'type' => 'TEXT',
                'value' => '123'
            ]
        ], $customFieldSet->toJson());
    }

    public function testItemTwice()
    {
        $this->expectException(OrderHiveDataException::class);

        CustomFieldsSet::of([
            CustomFields::of('a', 'TEXT', '123'),
            CustomFields::of('a', 'TEXT', '123')
        ]);
    }

    public function testGetShouldUseOrderItemIdAsKey()
    {
        $customFieldSet = CustomFieldsSet::of([
            CustomFields::of('a', 'TEXT', '123')
        ]);
        self::assertInstanceOf(CustomFields::class, $customFieldSet->get('a'));
        self::assertNull($customFieldSet->get('b'));
    }

    public function testEquality()
    {
        $customFieldSet = CustomFieldsSet::of([
            CustomFields::of('a', 'TEXT', '123'),
            CustomFields::of('b', 'TEXT', '123'),
            CustomFields::of('c', 'TEXT', '123'),
        ]);
        $sameSet = CustomFieldsSet::of([
            CustomFields::of('a', 'TEXT', '123'),
            CustomFields::of('b', 'TEXT', '123'),
            CustomFields::of('c', 'TEXT', '123'),
        ]);
        $notSameSet = CustomFieldsSet::of([
            CustomFields::of('a', 'TEXT', '111'),
            CustomFields::of('b', 'TEXT', '222'),
            CustomFields::of('c', 'TEXT', '333'),
        ]);

        self::assertTrue($customFieldSet->equals($sameSet));
        self::assertFalse($customFieldSet->equals($notSameSet));
    }

    private function getSampleData($name)
    {
        return [
            'name' => $name,
            'type' => 'NUMBER',
            'value' => '123'
        ];
    }
}
