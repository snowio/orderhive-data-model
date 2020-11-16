<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Product\Configurable\ConfigurableProduct;

final class CreateConfigurableProductCommand
{
    public static function of(ConfigurableProduct $product): self
    {
        $createProductCommand = new self;
        $createProductCommand->product = $product;
        return $createProductCommand;
    }

    public static function fromJson(array $json): self
    {
        $createProductCommand = new self;
        $createProductCommand->product = ConfigurableProduct::fromJson($json);
        return $createProductCommand;
    }

    public function getConfigurableProduct(): ConfigurableProduct
    {
        return $this->product;
    }

    public function toJson(): array
    {
        return $this->product->toJson();
    }

    /** @var ConfigurableProduct */
    private $product;

    private function __construct()
    {
    }
}
