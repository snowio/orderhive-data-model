<?php

namespace SnowIO\OrderHiveDataModel\Product;

class ConfigurableProduct
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
            ->withDescription($json['description'] ?? null)
            ->withBrand($json['brand'] ?? null)
            ->withCategory(Category::of($json['category']['name'] ?? null))
            ->withProductStores(ProductStoresSet::fromJson($json['product_stores'] ?? []))
            ->withMembers(MembersSet::fromJson($json['members'] ?? []))
            ->withProductOptions(ProductOptionsSet::fromJson($json['product_options'] ?? []));
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'brand' => $this->brand,
            'category' => $this->category->toJson(),
            'product_stores' => $this->productStores->toJson(),
            'product_options' => $this->productOptions->toJson(),
            'members' => $this->members->toJson(),
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof ConfigurableProduct) &&
        ($this->name === $object->name) &&
        ($this->description === $object->description) &&
        ($this->brand === $object->brand) &&
        ($this->category->equals($object->category)) &&
        ($this->productOptions->equals($object->productOptions)) &&
        ($this->members->equals($object->members)) &&
        ($this->productStores->equals($object->productStores));
    }

    private $name;
    private $description;
    private $brand;

    /** @var ProductStoresSet */
    private $productStores;

    /** @var ProductOptionsSet */
    private $productOptions;

    /** @var MembersSet */
    private $members;

    /** @var Category */
    private $category;

    private function __construct(string $name)
    {
        $this->name = $name;
        $this->productStores = ProductStoresSet::create();
        $this->productOptions = ProductOptionsSet::create();
        $this->members = MembersSet::create();
        $this->category = Category::create();
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

    public function withProductOptions(ProductOptionsSet $productOptions): self
    {
        $result = clone $this;
        $result->productOptions = $productOptions;
        return $result;
    }

    public function withMembers(MembersSet $members): self
    {
        $result = clone $this;
        $result->members = $members;
        return $result;
    }

    public function getProductOptions(): ProductOptionsSet
    {
        return $this->productOptions;
    }

    public function getMembers(): MembersSet
    {
        return $this->members;
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
