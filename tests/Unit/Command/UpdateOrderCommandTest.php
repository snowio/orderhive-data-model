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
            'store_id' => 46670,
            'order_status' => OrderStatus::SHIP,
            'tax_type' => "EXCLUSIVE",
            'currency' => "USD"
        ]);

        $expected = Order::of(28393283)
            ->withOrderStatus(OrderStatus::SHIP)
            ->withStoreId(46670)
            ->withCurrency("USD")
            ->withTaxType("EXCLUSIVE");

        self::assertTrue($expected->equals($updateOrderCommand->getOrder()));
    }

    public function testToJson()
    {
        $order = Order::of(28393283)
            ->withOrderStatus(OrderStatus::SHIP)
            ->withStoreId(46670)
            ->withCurrency("USD")
            ->withTaxType("EXCLUSIVE");

        $updateOrderCommand = UpdateOrderCommand::of($order);

        self::assertEquals([
            'reference_number' => 28393283,
            'order_status' => OrderStatus::SHIP,
            'store_id' => 46670,
            'warehouse_id' => null,
            'currency' => "USD",
            'tax_type' => "EXCLUSIVE",
            'payment_status' => null,
            'payment_method' => null,
            'delivery_date' => null,
            'grand_total' => null,
            'sync_created' => null,
            'channel_id' => null,
            'contact_id' => null,
            'base_currency_rate' => null,
            'base_currency' => null,
            'remark' => null,
            'channel_primary_id' => null,
            'channel_secondary_id' => null,
            'components' => null,
            'id' => null,
            'item_warehouse' => null,
            'meta_data' => null,
            'quantity_invoiced' => null,
            'tax_info' => [
                'id' => null,
                'tax_rate' => null,
                'groups' => [],
            ],
            'tax_value' => null,
            'update_type' => null,
            'weight' => null,
            'weight_unit' => null,
            'order_items' => [],
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
            ],
            'created_date' => null,
            'modified_date' => null,
        ], $updateOrderCommand->toJson());
    }
}