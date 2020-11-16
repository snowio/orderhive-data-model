<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Product\Bundle\BundleProduct;

final class CreateBundleProductCommand
{
    public static function of(BundleProduct $simpleProduct): self
    {
        $createProductCommand = new self;
        $createProductCommand->product = $simpleProduct;
        return $createProductCommand;
    }

    public static function fromJson(array $json): self
    {
        $createProductCommand = new self;
        $createProductCommand->product = BundleProduct::fromJson($json);
        return $createProductCommand;
    }

    public function getSimpleProduct(): BundleProduct
    {
        return $this->product;
    }

    public function toJson(): array
    {
        return $this->product->toJson();
    }

    /** @var BundleProduct */
    private $product;

    private function __construct()
    {
    }
}
