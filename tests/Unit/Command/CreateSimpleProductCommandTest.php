<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreateOrderCommand;
use SnowIO\OrderHiveDataModel\Command\CreateSimpleProductCommand;
use SnowIO\OrderHiveDataModel\Order\CreateOrder;
use SnowIO\OrderHiveDataModel\Order\CustomFields;
use SnowIO\OrderHiveDataModel\Order\CustomFieldsSet;
use SnowIO\OrderHiveDataModel\Order\Order;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;
use SnowIO\OrderHiveDataModel\Order\TaxInfo;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroup;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroupSet;
use SnowIO\OrderHiveDataModel\Product\Simple\SimpleProduct;

class CreateSimpleCommandTest extends TestCase
{
    public function testFromJson()
    {
        $createSimpleCommand = CreateSimpleProductCommand::fromJson([
            'sku' => 'sku'
        ]);

        $expected = SimpleProduct::of('sku');

        self::assertEquals($expected, $createSimpleCommand->getSimpleProduct());
    }

    public function testToJson()
    {
        $product = SimpleProduct::of('28393283')
            ->withName('name')
            ->withDescription('description')
            ->withBrand('brand')
            ->withBarcode('barcode')
            ->withThreshold(1)
            ->withWeight(1.0)
            ->withWeightUnit('kg');

        $createSimpleProductCommand = CreateSimpleProductCommand::of($product);

        self::assertEquals([
            'sku' => '28393283',
            'id' => null,
            'name' => 'name',
            'description' => 'description',
            'brand' => 'brand',
            'barcode' => 'barcode',
            'threshold' => 1,
            'weight' => 1.0,
            'weight_unit' => 'kg',
            'hsn_code' => null,
            'custom_fields' => [],
            'category' => [
                'name' => null
            ],
            'product_stores' => []
        ], $createSimpleProductCommand->toJson());
    }
}