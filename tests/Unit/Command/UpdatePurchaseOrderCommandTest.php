<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\UpdatePurchaseOrderCommand;
use SnowIO\OrderHiveDataModel\PurchaseOrder\CustomFields;
use SnowIO\OrderHiveDataModel\PurchaseOrder\CustomFieldsSet;
use SnowIO\OrderHiveDataModel\PurchaseOrder\EditPurchaseOrder;

class UpdatePurchaseOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $updateCommand = UpdatePurchaseOrderCommand::fromJson([
            'id' => 123,
            'payment_term' => '28393283',
            'note' => null,
            'expected_date' => null,
        ]);

        $expected = EditPurchaseOrder::of(123)
            ->withPaymentTerm('28393283');

        self::assertTrue($expected->equals($updateCommand->getEditPurchaseOrder()));
    }

    public function testToJson()
    {
        $order = EditPurchaseOrder::of(12)
            ->withPaymentTerm('term')
            ->withExpectedDate(date('Y-m-d'))
            ->withNote('note');

        $updateOrderCommand = UpdatePurchaseOrderCommand::of($order);

        self::assertEquals([
            'id' => 12,
            'note' => 'note',
            'payment_term' => 'term',
            'expected_date' => date('Y-m-d')
        ], $updateOrderCommand->toJson());
    }

    public function testToJsonWithOnlyFilledFields()
    {
        $updateOrderCommand = UpdatePurchaseOrderCommand::of(
            EditPurchaseOrder::of(12)
        );
        self::assertSame(['id' => 12], $updateOrderCommand->toJson());

        $updateOrderCommand = UpdatePurchaseOrderCommand::of(
            EditPurchaseOrder::of(12)
                ->withNote('note1')
        );
        self::assertSame([
            'id' => 12,
            'note' => 'note1'
        ], $updateOrderCommand->toJson());

        $updateOrderCommand = UpdatePurchaseOrderCommand::of(
            EditPurchaseOrder::of(12)
                ->withNote('note1')
                ->withExpectedDate(date('Y-m-d'))
        );
        self::assertSame([
            'id' => 12,
            'note' => 'note1',
            'expected_date' => date('Y-m-d'),
        ], $updateOrderCommand->toJson());
    }

    public function testToJsonWithCustomFields()
    {
        $updateOrderCommand = UpdatePurchaseOrderCommand::of(
            EditPurchaseOrder::of(12)
                ->withNote('note1')
                ->withExpectedDate(date('Y-m-d'))
                ->withCustomFields(CustomFieldsSet::of([
                    CustomFields::of('name', 'TEXT', 'value')
                ]))
        );
        self::assertSame([
            'id' => 12,
            'note' => 'note1',
            'expected_date' => date('Y-m-d'),
            'custom_fields' => [
                [
                    'name' => 'name',
                    'type' => 'TEXT',
                    'value' => 'value',
                ]
            ],
        ], $updateOrderCommand->toJson());
    }
}