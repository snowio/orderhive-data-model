<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\UpdateOrderStatusCommand;
use SnowIO\OrderHiveDataModel\Order\UpdateOrderStatus;

class UpdateOrderStatusCommandTest extends TestCase
{
    public function testFromJson()
    {
        $command = UpdateOrderStatusCommand::fromJson([
            'id' => 123,
            'order_status' => 'cancel'
        ]);

        $expected = UpdateOrderStatus::of(123)
            ->withOrderStatus('cancel');

        self::assertTrue($expected->equals($command->getUpdateOrderStatus()));
    }

    public function testToJson()
    {
        $order = UpdateOrderStatus::of(12)
            ->withCreatePayment(true)
            ->withRemark('remark')
            ->withDeliveryDate('2020-10-10')
            ->withSalesOrderId([123,321])
            ->withOrderStatus('cancel');

        $updateOrderCommand = UpdateOrderStatusCommand::of($order);

        self::assertEquals([
            'create_payment' => true,
            'order_status' => 'cancel',
            'remark' => 'remark',
            'delivery_date' => '2020-10-10',
            'id' => 12,
            'sales_order_id' => [123,321],
        ], $updateOrderCommand->toJson());


        $updateOrderCommand = UpdateOrderStatusCommand::of(
            UpdateOrderStatus::of(12)
            ->withOrderStatus('cancel')
        );

        self::assertSame([
            'id' => 12,
            'order_status' => 'cancel',
        ], $updateOrderCommand->toJson());
    }

    public function testGetters()
    {
        $order = UpdateOrderStatus::of(12)
            ->withCreatePayment(true)
            ->withRemark('remark')
            ->withDeliveryDate('2020-10-10')
            ->withSalesOrderId([123,321])
            ->withOrderStatus('cancel');

        $updateOrderCommand = UpdateOrderStatusCommand::of($order);

        self::assertEquals([
            'create_payment' => true,
            'order_status' => 'cancel',
            'remark' => 'remark',
            'delivery_date' => '2020-10-10',
            'id' => 12,
            'sales_order_id' => [123,321],
        ], $updateOrderCommand->toJson());


        $updateOrderCommand = UpdateOrderStatusCommand::of(
            UpdateOrderStatus::of(12)
                ->withOrderStatus('cancel')
        );

        self::assertSame([
            'id' => 12,
            'order_status' => 'cancel',
        ], $updateOrderCommand->toJson());
    }
}