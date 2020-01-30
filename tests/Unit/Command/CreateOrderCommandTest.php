<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreateOrderCommand;
use SnowIO\OrderHiveDataModel\Order\CreateOrder;
use SnowIO\OrderHiveDataModel\Order\Order;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;
use SnowIO\OrderHiveDataModel\Order\TaxInfo;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroup;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroupSet;

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
            'currency' => "USD",
        ]);

        $expected = CreateOrder::of('0001')
            ->withChannelOrderNumber('test')
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withStoreId(46670)
            ->withCurrency("USD")
            ->withTaxType("EXCLUSIVE");

        self::assertEquals($expected, $createOrderCommand->getCreateOrder());
    }

    public function testToJson()
    {
        $order = CreateOrder::of('28393283')
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withCurrency('USD')
            ->withStoreId(13);

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