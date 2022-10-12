<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\UpdateStockCommand;
use SnowIO\OrderHiveDataModel\Product\Remark;
use SnowIO\OrderHiveDataModel\Product\Simple\SimpleProduct;
use SnowIO\OrderHiveDataModel\Product\UpdateStock;
use SnowIO\OrderHiveDataModel\Product\Warehouse;
use SnowIO\OrderHiveDataModel\Product\WarehousesSet;

class UpdateStockCommandTest extends TestCase
{
    public function testFromJson()
    {
        $updateProduct = UpdateStockCommand::fromJson([
            'product_id' => 1,
            'warehouses' => [
              [
                "warehouse_id" => 2,
                "remark" => ['source'=> 'Test', 'desc' => null],
                "on_hand_quantity" => 1,
                "inventory_levels" => [],
              ]
            ]
        ]);

        $expected = UpdateStockCommand::of(
          UpdateStock::of(1)
            ->withWarehouses(WarehousesSet::of([
              Warehouse::of(2)
                ->withRemark(Remark::of('Test'))
                ->withOnHandQuantity(1)
            ]))
        );

        self::assertTrue($updateProduct->getUpdateStock()->equals($expected->getUpdateStock()));
    }

    public function testRemark()
    {
        $remark = Remark::of('Test')->toJson();
        self::assertSame(['source' => 'Test', 'desc' => null], $remark);

        $remark = Remark::create()->withDesc('desc')->withSource('test')->toJson();
        self::assertSame(['source' => 'test', 'desc' => 'desc'], $remark);

        $remark = Remark::create()->withDesc('desc')->withSource('test');
        self::assertSame('desc', $remark->getDesc());
        self::assertSame('test', $remark->getSource());
    }

    public function testToJson()
    {
        $updateProduct = UpdateStockCommand::fromJson([
          'product_id' => 1,
          'warehouses' => [
            [
              "warehouse_id" => 2,
              "remark" => ['source'=> 'Test', 'desc' => null],
              "on_hand_quantity" => 1,
              "inventory_levels" => [],
            ]
          ]
        ]);

        self::assertEquals([
          'product_id' => 1,
          'warehouses' => [
            [
              "warehouse_id" => 2,
              "remark" => ['source'=> 'Test', 'desc' => null],
              "on_hand_quantity" => 1,
              "inventory_levels" => [],
            ]
          ]
        ], $updateProduct->toJson());
    }
}
