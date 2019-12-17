<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\UpdateOrderCommand;
use SnowIO\OrderHiveDataModel\Order\Order;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;

class UpdateOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $updateOrderCommand = UpdateOrderCommand::fromJson([
            'reference_number' => 28393283,
            'store_id' => '46670',
            'order_status' => OrderStatus::SHIP,
            'tax_type' => "EXCLUSIVE",
            'currency' => "USD"
        ]);

        $expected = Order::of(28393283)
            ->withOrderStatus(OrderStatus::SHIP)
            ->withStoreId('46670')
            ->withCurrency("USD")
            ->withTaxType("EXCLUSIVE");

        self::assertTrue($expected->equals($updateOrderCommand->getOrder()));
    }

    public function testToJson()
    {
        $order = Order::of(28393283)
            ->withOrderStatus(OrderStatus::SHIP)
            ->withStoreId('46670')
            ->withCurrency("USD")
            ->withTaxType("EXCLUSIVE");

        $updateOrderCommand = UpdateOrderCommand::of($order);

        self::assertEquals([
            'reference_number' => 28393283,
            'order_status' => OrderStatus::SHIP,
            'store_id' => "46670",
            'warehouse_id' => null,
            'currency' => "USD",
            'tax_type' => "EXCLUSIVE",
            'order_items' => [],
            'shipping_address' => [],
            'billing_address' => [],
        ], $updateOrderCommand->toJson());
    }
}