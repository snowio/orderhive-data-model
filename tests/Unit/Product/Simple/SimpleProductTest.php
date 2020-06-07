<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Product\Simple;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\CustomFields;
use SnowIO\OrderHiveDataModel\Product\Category;
use SnowIO\OrderHiveDataModel\Product\CustomField;
use SnowIO\OrderHiveDataModel\Product\CustomFieldsSet;
use SnowIO\OrderHiveDataModel\Product\ProductStore;
use SnowIO\OrderHiveDataModel\Product\ProductStoresSet;
use SnowIO\OrderHiveDataModel\Product\Simple\SimpleProduct;

class SimpleProductTest extends TestCase
{
    private function getJsonData($name, $sku)
    {
        return [
            'name' => $name,
            'sku' => $sku,
            'id' => null,
            'barcode' => 'barcode',
            'threshold' => 0,
            'brand' => 'brand',
            'description' => 'description',
            'category' => [
                'name' => 'Category Test'
            ],
            'weight' => 1.20,
            'weight_unit' => 'kg',
            'hsn_code' => 'hsn',
            'custom_fields' => [
                [
                    'id' => 'name',
                    'value' => 'value',
                ]
            ],
            'product_stores' => [
                [
                    'store_id' => 46670,
                    'price' => '90'
                ]
            ]
        ];
    }

    public function testFromJsonToJson()
    {
        $data = $this->getJsonData('name', 'sku');

        $order = SimpleProduct::fromJson($data);

        self::assertEquals($data, $order->toJson());
    }

    public function testWithers()
    {
        $order = SimpleProduct::of('sku')
            ->withName('name')
            ->withBarcode('barcode')
            ->withThreshold(0)
            ->withBrand('brand')
            ->withHsnCode('hsn')
            ->withDescription('description')
            ->withWeight(1.20)
            ->withWeightUnit('kg')
            ->withCategory(Category::of('Category Test'))
            ->withCustomFields(CustomFieldsSet::of([
                CustomField::of('name')->withValue('value')
            ]))
            ->withProductStores(ProductStoresSet::of([
                ProductStore::of(46670)->withPrice('90')
            ]));

        self::assertEquals($this->getJsonData('name', 'sku'), $order->toJson());
    }

    public function testGetters()
    {
        $data = $this->getJsonData('name', 'sku');
        $order = SimpleProduct::fromJson($data);

        self::assertEquals($order->getId(), null);
        self::assertEquals($order->getName(), 'name');
        self::assertEquals($order->getBarcode(), 'barcode');
        self::assertEquals($order->getBrand(), 'brand');
        self::assertEquals($order->getDescription(), 'description');
        self::assertEquals($order->getHsnCode(), 'hsn');
        self::assertEquals($order->getThreshold(), 0);
        self::assertEquals($order->getWeight(), 1.20);
        self::assertEquals($order->getWeightUnit(), 'kg');
        self::assertEquals($order->getCategory(), Category::of('Category Test'));
        self::assertEquals($order->getCustomFields(), CustomFieldsSet::of([
            CustomField::of('name')->withValue('value')
        ]));
        self::assertEquals($order->getProductStores(), ProductStoresSet::of([
            ProductStore::of(46670)->withPrice('90')
        ]));
    }

    public function testEquals()
    {
        $product1 = SimpleProduct::fromJson($this->getJsonData('name', 'sku'));
        $product2 = SimpleProduct::fromJson($this->getJsonData('name', 'sku'));
        self::assertTrue($product1->equals($product2));
    }
}
