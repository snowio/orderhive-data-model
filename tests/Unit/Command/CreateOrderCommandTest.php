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
        $order = Order::of('28393283')
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
                'payment_status' => null,
                'payment_method' => null,
                'channel_primary_id' => null,
                'channel_secondary_id' => null,
                'components' => null,
                'id' => null,
                'item_warehouse' => null,
                'meta_data' => null,
                'product_image' => null,
                'quantity_invoiced' => null,
                'tax_info' => null,
                'tax_value' => null,
                'update_type' => null,
                'weight' => null,
                'weight_unit' => null,
                'delivery_date' => null,
                'grand_total' => null,
                'sync_created' => null,
                'channel_id' => null,
                'contact_id' => null,
                'base_currency_rate' => null,
                'base_currency' => null,
                'remark' => null,
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
            ]
        ], $createOrderCommand->toJson());
    }
}