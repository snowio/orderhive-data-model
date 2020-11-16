<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreateBundleProductCommand;
use SnowIO\OrderHiveDataModel\Product\Bundle\BundleProduct;
use SnowIO\OrderHiveDataModel\Product\Bundle\ComponentProduct;
use SnowIO\OrderHiveDataModel\Product\Bundle\ComponentProductsSet;
use SnowIO\OrderHiveDataModel\Product\Configurable\ConfigurableProduct;
use SnowIO\OrderHiveDataModel\Product\ProductStore;
use SnowIO\OrderHiveDataModel\Product\ProductStoresSet;

class CreateBundleCommandTest extends TestCase
{
    public function testFromJson()
    {
        $createBundleProductCommand = CreateBundleProductCommand::fromJson([
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
        ]);

        $expected = BundleProduct::of('name')
            ->withSku('123')
            ->withBundleComponents(ComponentProductsSet::of([
                ComponentProduct::of(45663673)->withQuantity(1),
                ComponentProduct::of(45663674)->withQuantity(1),
                ComponentProduct::of(45663675)->withQuantity(1),
            ]))
            ->withProductStores(ProductStoresSet::of([
                ProductStore::of(46670)->withPrice('100')
            ]));

        self::assertEquals($expected, $createBundleProductCommand->getSimpleProduct());
    }

    public function testToJson()
    {
        $product = BundleProduct::of('bundle name')
            ->withSku('sku');

        $createBundleProductCommand = CreateBundleProductCommand::of($product);

        self::assertEquals([
            'name' => 'bundle name',
            'sku' => 'sku',
            'bundle_components' => [],
            'product_stores' => [],
        ], $createBundleProductCommand->toJson());
    }
}
