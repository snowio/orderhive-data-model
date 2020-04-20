<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Product\Simple\SimpleProduct;

final class CreateSimpleProductCommand
{
    public static function of(SimpleProduct $simpleProduct): self
    {
        $createProductCommand = new self;
        $createProductCommand->product = $simpleProduct;
        return $createProductCommand;
    }

    public static function fromJson(array $json): self
    {
        $createProductCommand = new self;
        $createProductCommand->product = SimpleProduct::fromJson($json);
        return $createProductCommand;
    }

    public function getSimpleProduct(): SimpleProduct
    {
        return $this->product;
    }

    public function toJson(): array
    {
        return $this->product->toJson();
    }

    /** @var SimpleProduct */
    private $product;

    private function __construct()
    {

    }
}