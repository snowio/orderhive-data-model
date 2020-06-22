<?php

namespace SnowIO\OrderHiveDataModel\Product\Bundle;

class ComponentProduct
{
    public static function of(?int $productId): self
    {
        $item = new self($productId);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['component_product_id'] ?? null)
            ->withQuantity($json['component_quantity'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'component_product_id' => $this->productId,
            'component_quantity' => $this->quantity
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof BundleComponent) &&
        ($this->productId === $object->productId) &&
        ($this->quantity === $object->quantity);
    }

    private $productId;
    private $quantity;

    private function __construct(?int $productId)
    {
        $this->productId = $productId;
    }

    public function withQuantity(?int $quantity): self
    {
        $result = clone $this;
        $result->quantity = $quantity;
        return $result;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function withProductId(?int $productId): self
    {
        $result = clone $this;
        $result->productId = $productId;
        return $result;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }
}
