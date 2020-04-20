<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreateConfigurableProductCommand;
use SnowIO\OrderHiveDataModel\Product\Configurable\ConfigurableProduct;

class CreateConfigurableCommandTest extends TestCase
{
    public function testFromJson()
    {
        $createConfigurableCommand = CreateConfigurableProductCommand::fromJson([
            'name' => 'name'
        ]);

        $expected = ConfigurableProduct::of('name');

        self::assertEquals($expected, $createConfigurableCommand->getConfigurableProduct());
    }

    public function testToJson()
    {
        $product = ConfigurableProduct::of('configurable name')
            ->withDescription('description')
            ->withBrand('brand');

        $createConfigurableProductCommand = CreateConfigurableProductCommand::of($product);

        self::assertEquals([
            'name' => 'configurable name',
            'description' => 'description',
            'brand' => 'brand',
            'category' => [
                'name' => null
            ],
            'product_stores' => [],
            'product_options' => [],
            'members' => [],
        ], $createConfigurableProductCommand->toJson());
    }
}