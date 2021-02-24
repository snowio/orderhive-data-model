<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\UpdateBundleProductCommand;
use SnowIO\OrderHiveDataModel\Product\Bundle\BundleProduct;
use SnowIO\OrderHiveDataModel\Product\Bundle\ComponentProduct;
use SnowIO\OrderHiveDataModel\Product\Bundle\ComponentProductsSet;
use SnowIO\OrderHiveDataModel\Product\ProductStore;
use SnowIO\OrderHiveDataModel\Product\ProductStoresSet;

class UpdateBundleCommandTest extends TestCase
{
    public function testFromJson()
    {
        $updateProduct = UpdateBundleProductCommand::fromJson([
            'name' => 'product test',
            'sku' => 'test',
            'id' => 123
        ]);

        $expected = UpdateBundleProductCommand::of(
            123,
            BundleProduct::of('product test')
                ->withSku('test')
        );

        self::assertTrue($updateProduct->getBundleProduct()->equals($expected->getBundleProduct()));
        self::assertEquals($updateProduct->getId(), 123);
    }

    public function testToJson()
    {
        $productCommand = UpdateBundleProductCommand::of(
            123,
            BundleProduct::of('name')
                ->withSku('123')
                ->withBundleComponents(ComponentProductsSet::of([
                    ComponentProduct::of(45663673)->withQuantity(1),
                    ComponentProduct::of(45663674)->withQuantity(1),
                    ComponentProduct::of(45663675)->withQuantity(1),
                ]))
                ->withProductStores(ProductStoresSet::of([
                    ProductStore::of(46670)->withPrice('100')
                ]))
        );

        self::assertEquals([
            'id' => 123,
            'name' => 'name',
            'sku' => '123',
            'product_stores' => [
                [
                    "store_id" => 46670,
                    "price" => 100.0,
                ]
            ],
            'bundle_components' => [
                [
                    "component_product_id" => 45663673,
                    "component_quantity" => 1,
                ],
                [
                    "component_product_id" => 45663674,
                    "component_quantity" => 1,
                ],
                [
                    "component_product_id" => 45663675,
                    "component_quantity" => 1,
                ]
            ]
        ], $productCommand->toJson());
    }
}
