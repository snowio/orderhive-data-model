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
            CustomFields::of('field name', CustomFields::TYPE_NUMBER, '123')
        ]);

        self::assertEquals([
                $this->getSampleData('field name')
        ], $customFieldSet->toJson());
    }

    public function testAdditionToSet()
    {
        $customFieldSet = CustomFieldsSet::of([
            CustomFields::of('field name', CustomFields::TYPE_NUMBER, '123')
        ]);

        $customFieldSet = $customFieldSet->add(CustomFields::of('another field ', CustomFields::TYPE_NUMBER, '123'));
        $customFieldSet = $customFieldSet->add(CustomFields::of('field name', CustomFields::TYPE_NUMBER, '123'));

        self::assertCount(2, $customFieldSet->toJson());
    }

    public function testInvalidSetItemSetTwiceInOf()
    {
        $this->expectException(OrderHiveDataException::class);

        CustomFieldsSet::of([
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123'),
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123')
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
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123')->toJson(),
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123')->toJson(),
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
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123')
        ]);

        self::assertEquals([
            [
                'name' => 'a',
                'type' => CustomFields::TYPE_TEXT,
                'value' => '123'
            ]
        ], $customFieldSet->toJson());
    }

    public function testItemTwice()
    {
        $this->expectException(OrderHiveDataException::class);

        CustomFieldsSet::of([
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123'),
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123')
        ]);
    }

    public function testGetShouldUseOrderItemIdAsKey()
    {
        $customFieldSet = CustomFieldsSet::of([
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123')
        ]);
        self::assertInstanceOf(CustomFields::class, $customFieldSet->get('a'));
        self::assertNull($customFieldSet->get('b'));
    }

    public function testEquality()
    {
        $customFieldSet = CustomFieldsSet::of([
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123'),
            CustomFields::of('b', CustomFields::TYPE_TEXT, '123'),
            CustomFields::of('c', CustomFields::TYPE_TEXT, '123'),
        ]);
        $sameSet = CustomFieldsSet::of([
            CustomFields::of('a', CustomFields::TYPE_TEXT, '123'),
            CustomFields::of('b', CustomFields::TYPE_TEXT, '123'),
            CustomFields::of('c', CustomFields::TYPE_TEXT, '123'),
        ]);
        $notSameSet = CustomFieldsSet::of([
            CustomFields::of('a', CustomFields::TYPE_TEXT, '111'),
            CustomFields::of('b', CustomFields::TYPE_TEXT, '222'),
            CustomFields::of('c', CustomFields::TYPE_TEXT, '333'),
        ]);

        self::assertTrue($customFieldSet->equals($sameSet));
        self::assertFalse($customFieldSet->equals($notSameSet));
    }

    private function getSampleData($name)
    {
        return [
            'name' => $name,
            'type' => CustomFields::TYPE_NUMBER,
            'value' => '123'
        ];
    }
}
