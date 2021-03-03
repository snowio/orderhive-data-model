<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreatePurchaseOrderCommand;
use SnowIO\OrderHiveDataModel\PurchaseOrder\Create\PurchaseOrder;
use SnowIO\OrderHiveDataModel\PurchaseOrder\Create\PurchaseOrderItem;
use SnowIO\OrderHiveDataModel\PurchaseOrder\Create\PurchaseOrderItems;
use SnowIO\OrderHiveDataModel\PurchaseOrder\Create\Supplier;
use SnowIO\OrderHiveDataModel\PurchaseOrder\CustomFields;
use SnowIO\OrderHiveDataModel\PurchaseOrder\CustomFieldsSet;

class CreatePurchaseOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $createdCommand = CreatePurchaseOrderCommand::fromJson([
            'currency' => 'USD',
            'payment_term' => '28393283',
            "po_created_date" => '2021-02-02',
            'expected_date' => null,
            'warehouse' => ['id' => 123],
            'supplier' => [
                'id' => 123,
                'contact_id' => 321
            ],
            "base_currency_rate" => 1.0,
            "base_currency" => "INR",
            "total" => "4182.55",
            "update_warehouse_stock" => true,
            "update_incoming_on_draft" => false,
            "folder_detail" => null,
            "purchaseOrderExtraItems" => [],
            "purchaseOrderItems" => [
                [
                    "name" => "Tessen Console Table in natural mango",
                    "sku" => "tessenconnatural",
                    "itemId" => 32956865,
                    "qtyOrdered" => 1,
                    "tax_percent" => 0,
                    "buy_price" => "0",
                    "barcode" => "5057569238639"
                ]
            ],
            "custom_fields" => [
                [
                    "name" => "TID",
                    "type" => "TEXT",
                    "value" => "nei-test-123"
                ],
                [
                    "name" => "Required Delivery Date", // delivery date from Magento order item (expected_date)
                    "type" => "DATE",
                    "value" => "2021-01-22"
                ],
                [
                    "name" => "Is MTO?",
                    "type" => "CHECKBOX",
                    "value" => true, // fixed value
                    "id" => null
                ],
                [
                    "name" => "Original Delivery Date", // required custom field, ex-factory + x days
                    "type" => "DATE",
                    "value" => "2021-01-22"
                ]
            ]
        ]);

        $expected = PurchaseOrder::of()
            ->withPaymentTerm('28393283')
            ->withCurrency('USD')
            ->withPoCreatedDate('2021-02-02')
            ->withWarehouse(123)
            ->withSupplier(Supplier::of(123, 321))
            ->withBaseCurrencyRate(1)
            ->withBaseCurrency('INR')
            ->withTotal('4182.55')
            ->withUpdateWarehouseStock(true)
            ->withUpdateIncomingOnDraft(false)
            ->withPurchaseOrderItems(PurchaseOrderItems::of([
                PurchaseOrderItem::of('tessenconnatural')
                    ->withName('Tessen Console Table in natural mango')
                    ->withItemId(32956865)
                    ->withQtyOrdered(1)
                    ->withTaxPercent(0)
                    ->withBuyPrice('0')
                    ->withBarcode('5057569238639')
            ]))
            ->withCustomFields(CustomFieldsSet::of([
                CustomFields::of('TID', 'TEXT', 'nei-test-123'),
                CustomFields::of('Required Delivery Date', 'DATE', '2021-01-22'),
                CustomFields::of('Is MTO?', 'CHECKBOX', true),
                CustomFields::of('Original Delivery Date', 'DATE', "2021-01-22"),
            ]))
        ;

        self::assertEquals($expected, $createdCommand->getPurchaseOrder());
    }

    public function testToJson()
    {
        $po = PurchaseOrder::of()
            ->withPaymentTerm('28393283')
            ->withCurrency('USD')
            ->withPoCreatedDate('2021-02-02')
            ->withWarehouse(123)
            ->withSupplier(Supplier::of(123, 321))
            ->withBaseCurrencyRate(1)
            ->withBaseCurrency('INR')
            ->withTotal('4182.55')
            ->withUpdateWarehouseStock(true)
            ->withUpdateIncomingOnDraft(false)
            ->withPurchaseOrderItems(PurchaseOrderItems::of([
                PurchaseOrderItem::of('tessenconnatural')
                    ->withName('Tessen Console Table in natural mango')
                    ->withItemId(32956865)
                    ->withQtyOrdered(1)
                    ->withTaxPercent(0)
                    ->withBuyPrice('0')
                    ->withBarcode('5057569238639')
            ]))
            ->withCustomFields(CustomFieldsSet::of([
                CustomFields::of('TID', 'TEXT', 'nei-test-123'),
                CustomFields::of('Required Delivery Date', 'DATE', '2021-01-22'),
                CustomFields::of('Is MTO?', 'CHECKBOX', true),
                CustomFields::of('Original Delivery Date', 'DATE', "2021-01-22"),
            ]))
        ;

        $command = CreatePurchaseOrderCommand::of($po);

        self::assertEquals([
            'currency' => 'USD',
            'payment_term' => '28393283',
            "po_created_date" => '2021-02-02',
            'expected_date' => null,
            'warehouse' => ['id' => 123],
            'supplier' => [
                'id' => 123,
                'contact_id' => 321
            ],
            "base_currency_rate" => 1.0,
            "base_currency" => "INR",
            "total" => "4182.55",
            "update_warehouse_stock" => true,
            "update_incoming_on_draft" => false,
            "folder_detail" => null,
            "purchaseOrderExtraItems" => [],
            "purchaseOrderItems" => [
                [
                    "name" => "Tessen Console Table in natural mango",
                    "sku" => "tessenconnatural",
                    "itemId" => 32956865,
                    "qtyOrdered" => 1,
                    "tax_percent" => 0,
                    "buy_price" => "0",
                    "barcode" => "5057569238639"
                ]
            ],
            "custom_fields" => [
                [
                    "name" => "TID",
                    "type" => "TEXT",
                    "value" => "nei-test-123"
                ],
                [
                    "name" => "Required Delivery Date", // delivery date from Magento order item (expected_date)
                    "type" => "DATE",
                    "value" => "2021-01-22"
                ],
                [
                    "name" => "Is MTO?",
                    "type" => "CHECKBOX",
                    "value" => true
                ],
                [
                    "name" => "Original Delivery Date", // required custom field, ex-factory + x days
                    "type" => "DATE",
                    "value" => "2021-01-22"
                ]
            ]
        ], $command->toJson());
    }

    public function testToJsonWithOnlyFilledFields()
    {
        $createOrderCommand = CreatePurchaseOrderCommand::of(
            PurchaseOrder::of()->withCurrency('USD')
        );
        self::assertSame(['currency' => 'USD'], array_filter($createOrderCommand->toJson()));
    }

    public function testToJsonWithCustomFields()
    {
        $updateOrderCommand = CreatePurchaseOrderCommand::of(
            PurchaseOrder::of()
                ->withExpectedDate(date('Y-m-d'))
                ->withCustomFields(CustomFieldsSet::of([
                    CustomFields::of('name', 'TEXT', 'value')
                ]))
        );
        self::assertSame([
            'expected_date' => date('Y-m-d'),
            'custom_fields' => [
                [
                    'name' => 'name',
                    'type' => 'TEXT',
                    'value' => 'value',
                ]
            ],
        ], array_filter($updateOrderCommand->toJson()));
    }
}
