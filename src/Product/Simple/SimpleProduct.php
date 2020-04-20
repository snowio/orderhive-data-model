<?php

namespace SnowIO\OrderHiveDataModel\Product\Simple;

use SnowIO\OrderHiveDataModel\Product\Category;
use SnowIO\OrderHiveDataModel\Product\ProductStoresSet;

class SimpleProduct
{
    public static function of(string $sku): self
    {
        $item = new self($sku);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['sku'] ?? null)
            ->withName($json['name'] ?? null)
            ->withId($json['id'] ?? null)
            ->withDescription($json['description'] ?? null)
            ->withBrand($json['brand'] ?? null)
            ->withWeight($json['weight'] ?? null)
            ->withWeightUnit($json['weight_unit'] ?? null)
            ->withHsnCode($json['hsn_code'] ?? null)
            ->withBarcode($json['barcode'] ?? null)
            ->withThreshold($json['threshold'] ?? null)
            ->withCategory(Category::of($json['category']['name'] ?? null))
            ->withProductStores(ProductStoresSet::fromJson($json['product_stores'] ?? []));
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'brand' => $this->brand,
            'barcode' => $this->barcode,
            'threshold' => $this->threshold,
            'weight' => $this->weight,
            'weight_unit' => $this->weightUnit,
            'hsn_code' => $this->hsnCode,
            'category' => $this->category->toJson(),
            'product_stores' => $this->productStores->toJson()
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof SimpleProduct) &&
        ($this->id === $object->id) &&
        ($this->name === $object->name) &&
        ($this->sku === $object->sku) &&
        ($this->description === $object->description) &&
        ($this->brand === $object->brand) &&
        ($this->barcode === $object->barcode) &&
        ($this->threshold === $object->threshold) &&
        ($this->weight === $object->weight) &&
        ($this->weightUnit === $object->weightUnit) &&
        ($this->hsnCode === $object->hsnCode) &&
        ($this->category->equals($object->category)) &&
        ($this->productStores->equals($object->productStores));
    }

    private $id;
    private $name;
    private $sku;
    private $description;
    private $brand;
    private $barcode;
    private $threshold;
    private $weight;
    private $weightUnit;
    private $hsnCode;

    /** @var ProductStoresSet */
    private $productStores;

    /** @var Category */
    private $category;

    private function __construct(string $sku)
    {
        $this->sku = $sku;
        $this->productStores = ProductStoresSet::create();
        $this->category = Category::create();
    }

    public function withId(?int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function withThreshold(?int $threshold): self
    {
        $result = clone $this;
        $result->threshold = $threshold;
        return $result;
    }

    public function getThreshold(): ?int
    {
        return $this->threshold;
    }

    public function withHsnCode(?string $hsnCode): self
    {
        $result = clone $this;
        $result->hsnCode = $hsnCode;
        return $result;
    }

    public function getHsnCode(): ?string
    {
        return $this->hsnCode;
    }

    public function withDescription(?string $description): self
    {
        $result = clone $this;
        $result->description = $description;
        return $result;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function withBrand(?string $brand): self
    {
        $result = clone $this;
        $result->brand = $brand;
        return $result;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function withWeight(?float $weight): self
    {
        $result = clone $this;
        $result->weight = $weight;
        return $result;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function withWeightUnit(?string $weightUnit): self
    {
        $result = clone $this;
        $result->weightUnit = $weightUnit;
        return $result;
    }

    public function getWeightUnit(): ?string
    {
        return $this->weightUnit;
    }

    public function withBarcode(?string $barcode): self
    {
        $result = clone $this;
        $result->barcode = $barcode;
        return $result;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function withCategory(Category $category): self
    {
        $result = clone $this;
        $result->category = $category;
        return $result;
    }

    public function withProductStores(ProductStoresSet $productStores): self
    {
        $result = clone $this;
        $result->productStores = $productStores;
        return $result;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getProductStores(): ProductStoresSet
    {
        return $this->productStores;
    }
}
