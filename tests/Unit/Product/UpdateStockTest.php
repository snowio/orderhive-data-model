<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Product;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Product\InventoryLevels;
use SnowIO\OrderHiveDataModel\Product\InventoryLevelsSet;
use SnowIO\OrderHiveDataModel\Product\Remark;
use SnowIO\OrderHiveDataModel\Product\UpdateStock;
use SnowIO\OrderHiveDataModel\Product\Warehouse;
use SnowIO\OrderHiveDataModel\Product\WarehousesSet;

class UpdateStockTest extends TestCase
{
    private function getJsonData($warehouseId, $productId)
    {
        return [
            'product_id' => $productId,
            'warehouses' => [
                [
                    'warehouse_id' => $warehouseId,
                    "on_hand_quantity" => 400,
                    "remark" => [
                        "source" => "Manual Adjustment"
                    ],
                    "inventory_levels" => [
                        [
                            "location" => "L1",
                            "product_id" => $productId,
                            "quantity" => 400,
                            "warehouse_id" => $warehouseId,
                            "is_default" => true,
                            "batch" => "B1",
                            "cost" => "56.56"
                        ]
                    ]
                ]
            ]
        ];
    }


    public function testFromJsonToJson()
    {
        $data = $this->getJsonData(1111, 3333);

        $order = UpdateStock::fromJson($data);

        self::assertEquals($data, $order->toJson());
    }

    public function testWithers()
    {
        $order = UpdateStock::of(123)
            ->withWarehouses(WarehousesSet::of([
                Warehouse::of(1)
                    ->withRemark(Remark::of('Manual Adjustment'))
                    ->withOnHandQuantity(400)
                    ->withWarehouseId(0001)
                    ->withInventoryLevels(InventoryLevelsSet::of([
                        InventoryLevels::of(123, 400)
                            ->withLocation('L1')
                            ->withIsDefault(true)
                            ->withBatch('B1')
                            ->withCost('56.56')
                            ->withWarehouseId(1)
                    ]))
            ]));

        self::assertEquals($this->getJsonData(1, 123), $order->toJson());
    }

    public function testGetters()
    {
        $data = $this->getJsonData(111111, 123);
        $order = UpdateStock::fromJson($data);

        self::assertEquals($order->getProductId(), 123);
        self::assertEquals($order->getWarehouses(), WarehousesSet::of([
            Warehouse::of(111111)
                ->withRemark(Remark::of('Manual Adjustment'))
                ->withOnHandQuantity(400)
                ->withInventoryLevels(InventoryLevelsSet::of([
                    InventoryLevels::of(123, 400)
                        ->withLocation('L1')
                        ->withIsDefault(true)
                        ->withBatch('B1')
                        ->withCost('56.56')
                        ->withWarehouseId(111111)
                ]))
        ]));
    }
}
