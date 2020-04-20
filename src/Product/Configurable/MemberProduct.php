<?php

namespace SnowIO\OrderHiveDataModel\Product\Configurable;

use SnowIO\OrderHiveDataModel\Product\Category;
use SnowIO\OrderHiveDataModel\Product\CustomFieldsSet;
use SnowIO\OrderHiveDataModel\Product\ProductStoresSet;

class MemberProduct
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
            ->withOption1($json['option1'] ?? null)
            ->withOption2($json['option2'] ?? null)
            ->withOption3($json['option3'] ?? null)
            ->withOption4($json['option4'] ?? null)
            ->withOption5($json['option5'] ?? null)
            ->withProductStores(ProductStoresSet::fromJson($json['product_stores'] ?? []))
            ->withProductPrices(ProductPricesSet::fromJson($json['product_prices'] ?? []))
            ->withCustomFields(CustomFieldsSet::fromJson($json['custom_fields'] ?? []));
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'option3' => $this->option3,
            'option4' => $this->option4,
            'option5' => $this->option5,
            'product_stores' => $this->productStores->toJson(),
            'product_prices' => $this->productPrices->toJson(),
            'custom_fields' => $this->customFields->toJson()
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof MemberProduct) &&
        ($this->name === $object->name) &&
        ($this->sku === $object->sku) &&
        ($this->option1 === $object->option1) &&
        ($this->option2 === $object->option2) &&
        ($this->option3 === $object->option3) &&
        ($this->option4 === $object->option4) &&
        ($this->option5 === $object->option5) &&
        ($this->customFields->equals($object->customFields)) &&
        ($this->productStores->equals($object->productStores)) &&
        ($this->productPrices->equals($object->productPrices));
    }

    private $name;
    private $sku;
    private $option1;
    private $option2;
    private $option3;
    private $option4;
    private $option5;

    /** @var ProductStoresSet */
    private $productStores;

    /** @var ProductPricesSet */
    private $productPrices;

    /** @var CustomFieldsSet */
    private $customFields;

    /** @var Category */
    private $category;

    private function __construct(string $sku)
    {
        $this->sku = $sku;
        $this->productStores = ProductStoresSet::create();
        $this->customFields = CustomFieldsSet::create();
        $this->category = Category::create();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function withName(?string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function withOption1(?string $option): self
    {
        $result = clone $this;
        $result->option1 = $option;
        return $result;
    }

    public function withOption2(?string $option): self
    {
        $result = clone $this;
        $result->option2 = $option;
        return $result;
    }

    public function withOption3(?string $option): self
    {
        $result = clone $this;
        $result->option3 = $option;
        return $result;
    }

    public function withOption4(?string $option): self
    {
        $result = clone $this;
        $result->option4 = $option;
        return $result;
    }

    public function withOption5(?string $option): self
    {
        $result = clone $this;
        $result->option5 = $option;
        return $result;
    }

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function getOption3(): ?string
    {
        return $this->option3;
    }

    public function getOption4(): ?string
    {
        return $this->option4;
    }

    public function getOption5(): ?string
    {
        return $this->option5;
    }

    public function withProductStores(ProductStoresSet $productStores): self
    {
        $result = clone $this;
        $result->productStores = $productStores;
        return $result;
    }

    public function withProductPrices(ProductPricesSet $productPrices): self
    {
        $result = clone $this;
        $result->productPrices = $productPrices;
        return $result;
    }

    public function withCustomFields(CustomFieldsSet $customFields): self
    {
        $result = clone $this;
        $result->customFields = $customFields;
        return $result;
    }

    public function getProductStores(): ProductStoresSet
    {
        return $this->productStores;
    }

    public function getCustomFields(): CustomFieldsSet
    {
        return $this->customFields;
    }

    public function getProductPrices(): ProductPricesSet
    {
        return $this->productPrices;
    }
}
