<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\UpdateSimpleProductCommand;
use SnowIO\OrderHiveDataModel\Product\Simple\SimpleProduct;

class UpdateSimpleCommandTest extends TestCase
{
    public function testFromJson()
    {
        $updateProduct = UpdateSimpleProductCommand::fromJson([
            'id' => 123,
            'name' => 'product test',
            'sku' => 'test'
        ]);

        $expected = UpdateSimpleProductCommand::of(
            SimpleProduct::of('test')
                ->withId(123)
                ->withName('product test')
        );

        self::assertTrue($updateProduct->getSimpleProduct()->equals($expected->getSimpleProduct()));
    }

    public function testToJson()
    {
        $productCommand = UpdateSimpleProductCommand::of(
            SimpleProduct::of('sku')
                ->withName('test')
                ->withId(123)
        );

        self::assertEquals([
            'id' => 123,
            'sku' => 'sku',
            'name' => 'test',
            'description' => null,
            'brand' => null,
            'barcode' => null,
            'threshold' => null,
            'weight' => null,
            'weight_unit' => null,
            'hsn_code' => null,
            'category' => [
                'name' => null
            ],
            'custom_fields' => [],
            'product_stores' => []
        ], $productCommand->toJson());
    }

    public function testExceptionWhenIdNotSet()
    {
        self::expectExceptionMessage('id must be present in order to update the product');
        self::expectException(\DomainException::class);

        UpdateSimpleProductCommand::of(
            SimpleProduct::of('sku')
                ->withName('test')
        );
    }
}
