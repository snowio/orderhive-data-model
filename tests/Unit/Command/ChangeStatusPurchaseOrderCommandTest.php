<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\ChangeStatusPurchaseOrderCommand;
use SnowIO\OrderHiveDataModel\PurchaseOrder\ChangeStatusPurchaseOrder;

class ChangeStatusPurchaseOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $updateCommand = ChangeStatusPurchaseOrderCommand::fromJson([
            'id' => [123],
            'status' => 'statusTo',
        ]);

        $expected = ChangeStatusPurchaseOrder::of([123], 'initalvalue')
            ->withStatus('statusTo');

        self::assertTrue($expected->equals($updateCommand->getChangeStatusPurchaseOrder()));
    }

    public function testToJson()
    {
        $order = ChangeStatusPurchaseOrder::of([1,2],'initialvalue')
            ->withStatus('status');

        $updateOrderCommand = ChangeStatusPurchaseOrderCommand::of($order);

        self::assertEquals([
            'id' => [1,2],
            'status' => 'status',
        ], $updateOrderCommand->toJson());
    }
}
