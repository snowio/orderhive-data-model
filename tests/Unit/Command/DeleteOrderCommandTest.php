<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\DeleteOrderCommand;
use SnowIO\OrderHiveDataModel\Order\Order;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;

class DeleteOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $deleteOrderCommand = DeleteOrderCommand::fromJson([
            'sales_orders_id' => [1,2,3]
        ]);

        self::assertSame($deleteOrderCommand->toJson(), ['sales_orders_id' => [1,2,3]]);
    }

    public function testToJson()
    {
        $deleteCommand = DeleteOrderCommand::of([1,2,3]);

        self::assertEquals([
            'sales_orders_id' => [1,2,3],
        ], $deleteCommand->toJson());
    }
}
