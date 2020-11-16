<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Product\Bundle;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Product\Bundle\BundleProduct;
use SnowIO\OrderHiveDataModel\Product\Bundle\ComponentProduct;
use SnowIO\OrderHiveDataModel\Product\Bundle\ComponentProductsSet;
use SnowIO\OrderHiveDataModel\Product\Category;
use SnowIO\OrderHiveDataModel\Product\Configurable\ConfigurableProduct;
use SnowIO\OrderHiveDataModel\Product\Configurable\MemberProduct;
use SnowIO\OrderHiveDataModel\Product\Configurable\MembersSet;
use SnowIO\OrderHiveDataModel\Product\Configurable\ProductOption;
use SnowIO\OrderHiveDataModel\Product\Configurable\ProductOptionsSet;
use SnowIO\OrderHiveDataModel\Product\Configurable\ProductPrice;
use SnowIO\OrderHiveDataModel\Product\Configurable\ProductPricesSet;
use SnowIO\OrderHiveDataModel\Product\ProductStore;
use SnowIO\OrderHiveDataModel\Product\ProductStoresSet;

class BundleProductTest extends TestCase
{
    private function getJsonData($modelName)
    {
        return [
            'name' => $modelName,
            'sku' => 'sku',
            'product_stores' => [
                [
                    'store_id' => 46670,
                    'price' => null,
                ]
            ],
            'bundle_components' => [
                [
                    'component_product_id' => 45663673,
                    'component_quantity' => 1,
                ]
            ]
        ];
    }

    public function testFromJsonToJson()
    {
        $data = $this->getJsonData('model');

        $order = BundleProduct::fromJson($data);

        self::assertEquals($data, $order->toJson());
    }

    public function testWithers()
    {
        $product = BundleProduct::of('name')
            ->withSku('sku')
            ->withProductStores(ProductStoresSet::of([
                ProductStore::of(46670)
            ]))
            ->withBundleComponents(ComponentProductsSet::of([
                ComponentProduct::of(45663673)->withQuantity(1)
            ]));

        self::assertEquals($this->getJsonData('name'), $product->toJson());
    }

    public function testGetters()
    {
        $data = $this->getJsonData('name');
        $product = BundleProduct::fromJson($data);

        self::assertEquals($product->getName(), 'name');
        self::assertEquals($product->getSku(), 'sku');
        self::assertEquals($product->getProductStores(), ProductStoresSet::of([
            ProductStore::of(46670)
        ]));

        self::assertEquals($product->getBundleComponents(), ComponentProductsSet::of([
            ComponentProduct::of(45663673)->withQuantity(1)
        ]));
    }
}
