<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Product\Bundle\BundleProduct;

final class UpdateBundleProductCommand
{
    public static function of(int $id, BundleProduct $bundleProduct): self
    {
        $updateProduct = new self;
        $updateProduct->id = $id;
        $updateProduct->bundleProduct = $bundleProduct;
        return $updateProduct;
    }

    public static function fromJson(array $json): self
    {
        $updateProduct = new self;
        $updateProduct->bundleProduct = BundleProduct::fromJson($json);
        $updateProduct->id = $json['id'] ?? null;
        return $updateProduct;
    }

    public function getBundleProduct(): BundleProduct
    {
        return $this->bundleProduct;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function toJson(): array
    {
        return array_merge($this->bundleProduct->toJson(), [
            'id' => $this->id
        ]);
    }

    /** @var BundleProduct */
    private $bundleProduct;

    private $id;

    private function __construct()
    {
    }
}
