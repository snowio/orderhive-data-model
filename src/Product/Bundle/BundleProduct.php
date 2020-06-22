<?php

namespace SnowIO\OrderHiveDataModel\Product\Bundle;

use SnowIO\OrderHiveDataModel\Product\ProductStoresSet;

class BundleProduct
{
    public static function of(?string $name): self
    {
        $item = new self($name);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['name'] ?? null)
            ->withSku($json['sku'] ?? null)
            ->withBundleComponents(ComponentProductsSet::fromJson($json['bundle_components'] ?? []))
            ->withProductStores(ProductStoresSet::fromJson($json['product_stores'] ?? []));
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'product_stores' => $this->productStores->toJson(),
            'bundle_components' => $this->componentsProducts->toJson(),
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof BundleProduct) &&
        ($this->name === $object->name) &&
        ($this->sku === $object->sku) &&
        ($this->componentsProducts->equals($object->componentsProducts)) &&
        ($this->productStores->equals($object->productStores));
    }

    private $name;
    private $sku;

    /** @var ProductStoresSet */
    private $productStores;

    /** @var ComponentProductsSet */
    private $componentsProducts;

    private function __construct(string $name)
    {
        $this->name = $name;
        $this->productStores = ProductStoresSet::create();
        $this->componentsProducts = ComponentProductsSet::create();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function withName(?string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function withSku(?string $sku): self
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function withProductStores(ProductStoresSet $productStores): self
    {
        $result = clone $this;
        $result->productStores = $productStores;
        return $result;
    }

    public function getProductStores(): ProductStoresSet
    {
        return $this->productStores;
    }

    public function withBundleComponents(ComponentProductsSet $components): self
    {
        $result = clone $this;
        $result->componentsProducts = $components;
        return $result;
    }

    public function getBundleComponents(): ComponentProductsSet
    {
        return $this->componentsProducts;
    }
}
