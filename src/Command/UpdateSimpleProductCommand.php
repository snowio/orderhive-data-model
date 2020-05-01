<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Product\Simple\SimpleProduct;

final class UpdateSimpleProductCommand
{
    public static function of(SimpleProduct $simpleProduct): self
    {
        if (!$simpleProduct->getId()) {
            throw new \DomainException('id must be present in order to update the product');
        }
        $updateProduct = new self;
        $updateProduct->simpleProduct = $simpleProduct;
        return $updateProduct;
    }

    public static function fromJson(array $json): self
    {
        $updateProduct = new self;
        $updateProduct->simpleProduct = SimpleProduct::fromJson($json);
        return $updateProduct;
    }

    public function getSimpleProduct(): SimpleProduct
    {
        return $this->simpleProduct;
    }

    public function toJson(): array
    {
        return $this->simpleProduct->toJson();
    }

    /** @var SimpleProduct */
    private $simpleProduct;

    private function __construct()
    {

    }
}