<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreateOrderCommand;
use SnowIO\OrderHiveDataModel\Order\Order;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;

class CreateOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $createOrderCommand = CreateOrderCommand::fromJson([
            'reference_number' => 0001,
            'store_id' => '46670',
            'order_status' => OrderStatus::CONFIRM,
            'tax_type' => "EXCLUSIVE",
            'currency' => "USD",
        ]);

        $expected = Order::of(0001)
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withStoreId('46670')
            ->withCurrency("USD")
            ->withTaxType("EXCLUSIVE");

        self::assertEquals($expected, $createOrderCommand->getOrder());
    }

    public function testToJson()
    {
        $order = Order::of(28393283)
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withCurrency('USD')
            ->withStoreId(13);

        $createOrderCommand = CreateOrderCommand::of($order);

        self::assertEquals([
            [
                'order_status' => OrderStatus::CONFIRM,
                'warehouse_id' => null,
                'reference_number' => '28393283',
                'currency' => 'USD',
                'store_id' => 13,
                'tax_type' => null,
                'order_items' => [],
                'shipping_address' => [],
                'billing_address' => [],
            ]
        ], $createOrderCommand->toJson());
    }
}