<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreateOrderCommand;
use SnowIO\OrderHiveDataModel\Command\ReceivePurchaseOrderCommand;
use SnowIO\OrderHiveDataModel\Order\CreateOrder;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;
use SnowIO\OrderHiveDataModel\PurchaseOrder\PurchaseOrderItem;
use SnowIO\OrderHiveDataModel\PurchaseOrder\PurchaseOrderItems;
use SnowIO\OrderHiveDataModel\PurchaseOrder\ReceivePurchaseOrder;
use SnowIO\OrderHiveDataModel\PurchaseOrder\WarehouseLocation;
use SnowIO\OrderHiveDataModel\PurchaseOrder\WarehouseLocations;

class ReceivePurchaseOrderCommandTest extends TestCase
{
    public function testFromJson()
    {
        $receivePoCommand = ReceivePurchaseOrderCommand::fromJson([
            'id' => 123,
            'purchaseOrderItems' => [
                [
                    'id' => 1,
                    'itemId' => 2,
                    'qtyReceived' => 3,
                    'warehouse_location' => [
                        [
                            'batch' => 'xxx',
                            'location' => 'location',
                            'quantity' => '2',
                            'cost' => '99.99'
                        ]
                    ]
                ]
            ]
        ]);

        $expected = ReceivePurchaseOrderCommand::of(
            ReceivePurchaseOrder::of(123)
                ->withPurchaseOrderItems(PurchaseOrderItems::of([
                    PurchaseOrderItem::of(1)
                        ->withItemId(2)
                        ->withQtyReceived(3)
                        ->withWarehouseLocation(
                            WarehouseLocations::of([
                                WarehouseLocation::of('xxx')
                                    ->withLocation('location')
                                    ->withQuantity(2)
                                    ->withCost(99.99)
                            ])
                        )
                ]))
        );

        self::assertEquals($expected, $receivePoCommand);
    }

    public function testToJson()
    {
        $po = ReceivePurchaseOrder::of(123)
            ->withPurchaseOrderItems(PurchaseOrderItems::of([
                PurchaseOrderItem::of(1)
                    ->withItemId(2)
                    ->withQtyReceived(3)
                    ->withWarehouseLocation(
                        WarehouseLocations::of([
                            WarehouseLocation::of('xxx')
                                ->withLocation('location')
                                ->withQuantity(2)
                                ->withCost(99.99)
                        ])
                    )
            ]));

        $poCommand = ReceivePurchaseOrderCommand::of($po);

        self::assertEquals([
            'id' => 123,
            'purchaseOrderItems' => [
                [
                    'id' => 1,
                    'itemId' => 2,
                    'qtyReceived' => 3,
                    'warehouse_location' => [
                        [
                            'batch' => 'xxx',
                            'location' => 'location',
                            'quantity' => '2',
                            'cost' => '99.99'
                        ]
                    ]
                ]
            ]
        ], $poCommand->toJson());
    }
}