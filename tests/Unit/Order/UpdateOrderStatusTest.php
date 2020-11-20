<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\Address;
use SnowIO\OrderHiveDataModel\Order\ItemSet;
use SnowIO\OrderHiveDataModel\Order\Item;
use SnowIO\OrderHiveDataModel\Order\OrderCredit;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;
use SnowIO\OrderHiveDataModel\Order\Payment;
use SnowIO\OrderHiveDataModel\Order\PaymentSet;
use SnowIO\OrderHiveDataModel\Order\OrderCreditSet;
use SnowIO\OrderHiveDataModel\Order\Order;
use SnowIO\OrderHiveDataModel\Order\PaymentStatus;
use SnowIO\OrderHiveDataModel\Order\ProductImage;
use SnowIO\OrderHiveDataModel\Order\TaxInfo;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroup;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroupSet;
use SnowIO\OrderHiveDataModel\Order\UpdateOrderStatus;

class UpdateOrderStatusTest extends TestCase
{
    public function testFromJsonToJson()
    {
        $data = [
            'create_payment' => true,
            'order_status' => 'cancel',
            'remark' => 'remark',
            'delivery_date' => '2020-10-10',
            'id' => 12,
            'sales_order_id' => [123,321],
        ];

        $order = UpdateOrderStatus::fromJson($data);

        self::assertEquals($data, $order->toJson());
    }

    public function testWithers()
    {
        $order = UpdateOrderStatus::of(12)
            ->withOrderStatus('cancel')
            ->withSalesOrderId([123, 321])
            ->withDeliveryDate('2020-10-10')
            ->withRemark('remark')
            ->withCreatePayment(true)
            ;

        self::assertEquals([
            'create_payment' => true,
            'order_status' => 'cancel',
            'remark' => 'remark',
            'delivery_date' => '2020-10-10',
            'id' => 12,
            'sales_order_id' => [123,321],
        ], $order->toJson());
    }

    public function testGetters()
    {
        $order = UpdateOrderStatus::fromJson([
            'create_payment' => true,
            'order_status' => 'cancel',
            'remark' => 'remark',
            'delivery_date' => '2020-10-10',
            'id' => 12,
            'sales_order_id' => [123,321],
        ]);

        self::assertEquals($order->getId(), 12);
        self::assertEquals($order->getCreatePayment(), true);
        self::assertEquals($order->getOrderStatus(), 'cancel');
        self::assertEquals($order->getRemark(), 'remark');
        self::assertEquals($order->getDeliveryDate(), '2020-10-10');
        self::assertEquals($order->getSalesOrderId(), [123,321]);
    }

    public function testEquals()
    {
        $order1 = UpdateOrderStatus::fromJson([
            'create_payment' => true,
            'order_status' => 'cancel',
            'remark' => 'remark',
            'delivery_date' => '2020-10-10',
            'id' => 12,
            'sales_order_id' => [123,321],
        ]);

        $order2 = UpdateOrderStatus::fromJson([
            'create_payment' => true,
            'order_status' => 'cancel',
            'remark' => 'remark',
            'delivery_date' => '2020-10-10',
            'id' => 12,
            'sales_order_id' => [123,321],
        ]);

        self::assertTrue($order1->equals($order2));

        $order2 = $order2->withCreatePayment(false);
        self::assertFalse($order1->equals($order2));

    }
}
