<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\UpdateOrderCommand;
use SnowIO\OrderHiveDataModel\Order\EditOrder;
use SnowIO\OrderHiveDataModel\Order\Order;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;

class UpdateOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $updateOrderCommand = UpdateOrderCommand::fromJson([
            'id' => 123,
            'reference_number' => '28393283',
            'contact_id' => 123
        ]);

        $expected = EditOrder::of(123)
            ->withReferenceNumber('28393283')
            ->withContactId(123);

        self::assertTrue($expected->equals($updateOrderCommand->getEditOrder()));
    }

    public function testToJson()
    {
        $order = EditOrder::of(12)
            ->withReferenceNumber('28393283')
            ->withContactId(123)
            ->withChannelOrderNumber('xx1')
            ->withPaymentMethod('pay')
            ->withSalesPersonId(1)
            ->withShippingCarrier('x')
            ->withShippingService('y')
            ->withPresetId('1');

        $updateOrderCommand = UpdateOrderCommand::of($order);

        self::assertEquals([
            'contact_id' => 123,
            'channel_order_number' => 'xx1',
            'payment_method' => 'pay',
            'reference_number' => '28393283',
            'sales_person_id' => 1,
            'remark' => null,
            'delivery_date' => null,
            'shipping_carrier' => 'x',
            'shipping_service' => 'y',
            'preset_id' => '1',
            'id' => 12,
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
            'order_items' => [],
        ], $updateOrderCommand->toJson());
    }

    public function testToJsonFiltered()
    {
        $payload = UpdateOrderCommand::of(
            EditOrder::of(127939562)
                ->withDeliveryDate('2021-07-06 00:00:00')
        )->toJsonFiltered(['id', 'delivery_date', 'shipping_address']);

        self::assertEquals([
            'id' => 127939562,
            'delivery_date' => '2021-07-06 00:00:00',
            'shipping_address' => [
                "address1" => null,
                "address2" => null,
                "city" => null,
                "company" => null,
                "contact_number" => null,
                "country" => null,
                "country_code" => null,
                "created" => null,
                "email" => null,
                "id" => null,
                "modified" => null,
                "name" => null,
                "state" => null,
                "zipcode" => null,
            ]
        ], $payload);
    }

}
