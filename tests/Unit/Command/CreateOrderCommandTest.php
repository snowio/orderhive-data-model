<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreateOrderCommand;
use SnowIO\OrderHiveDataModel\Order\CreateOrder;
use SnowIO\OrderHiveDataModel\Order\CustomFields;
use SnowIO\OrderHiveDataModel\Order\CustomFieldsSet;
use SnowIO\OrderHiveDataModel\Order\ExtraItem;
use SnowIO\OrderHiveDataModel\Order\ExtraItemSet;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;

class CreateOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $createOrderCommand = CreateOrderCommand::fromJson([
            'id' => 123,
            'reference_number' => '0001',
            'store_id' => 46670,
            'order_status' => OrderStatus::CONFIRM,
            'channel_order_number' => 'test',
            'tax_type' => "EXCLUSIVE",
            'custom_fields' => [
                ["name" => "PO Reference", "type" => "TEXT", "value" => "123"]
            ],
            "order_extra_items" => [[
                "name" => "Shipping & Handling",
                "price" => 50,
                "quantity_ordered" => 1,
                "row_total" => 50,
                "tax_percent" => 0,
                "update_type" => "ADD",
                "type" => "SHIPPING_COST",
            ]],
            'currency' => "USD",
        ]);

        $expected = CreateOrder::of('0001')
            ->withChannelOrderNumber('test')
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withStoreId(46670)
            ->withCurrency("USD")
            ->withTaxType("EXCLUSIVE")
            ->withCustomFields(CustomFieldsSet::of([CustomFields::of('PO Reference', CustomFields::TYPE_TEXT, '123')]))
            ->withOrderExtraItems(ExtraItemSet::of([
                ExtraItem::of('Shipping & Handling')
                    ->withPrice(50)
                    ->withQuantityOrdered(1)
                    ->withRowTotal(50)
                    ->withTaxPercent(0)
                    ->withUpdateType('ADD')
                    ->withType('SHIPPING_COST')
            ]));

        self::assertEquals($expected, $createOrderCommand->getCreateOrder());
    }

    public function testToJson()
    {
        $order = CreateOrder::of('28393283')
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withCurrency('USD')
            ->withStoreId(13)
            ->withCustomFields(CustomFieldsSet::of([CustomFields::of('PO Reference', CustomFields::TYPE_TEXT, '123')]));

        $createOrderCommand = CreateOrderCommand::of($order);

        self::assertEquals([
            'order_status' => OrderStatus::CONFIRM,
            'warehouse_id' => null,
            'reference_number' => '28393283',
            'currency' => 'USD',
            'store_id' => 13,
            'tax_type' => null,
            'payment_status' => null,
            'payment_method' => null,
            'delivery_date' => null,
            'channel_order_number' => null,
            'grand_total' => null,
            'sync_created' => null,
            'contact_id' => null,
            'base_currency_rate' => null,
            'base_currency' => null,
            'remark' => null,
            'order_items' => [],
            'custom_fields' => [
                [
                    "name" => "PO Reference",
                    "type" => CustomFields::TYPE_TEXT,
                    "value" => "123",
                ]
            ],
            'order_extra_items' => [],
            'shipping_address' => [
                'address1' => null,
                'address2' => null,
                'city' => null,
                'company' => null,
                'contact_number' => null,
                'country' => null,
                'country_code' => null,
                'created' => null,
                'email' => null,
                'id' => null,
                'modified' => null,
                'name' => null,
                'state' => null,
                'zipcode' => null,
            ],
            'billing_address' => [
                'address1' => null,
                'address2' => null,
                'city' => null,
                'company' => null,
                'contact_number' => null,
                'country' => null,
                'country_code' => null,
                'created' => null,
                'email' => null,
                'id' => null,
                'modified' => null,
                'name' => null,
                'state' => null,
                'zipcode' => null,
            ]
        ], $createOrderCommand->toJson());
    }
}