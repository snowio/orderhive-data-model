<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product;

final class InventoryLevels
{
    private $location;
    private $productId;
    private $quantity;
    private $warehouseId;
    private $isDefault;
    private $batch;
    private $cost;

    public static function of(?int $productId, ?int $quantity): self
    {
        $item = (new self($productId, $quantity));
        return $item;
    }

    private function __construct(?int $productId, ?int $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public static function fromJson($json): self
    {
        $result = self::of($json['product_id'], $json['quantity']);
        $result->location = $json['location'] ?? null;
        $result->warehouseId = $json['warehouse_id'] ?? null;
        $result->isDefault = $json['is_default'] ?? null;
        $result->batch = $json['batch'] ?? null;
        $result->cost = $json['cost'] ?? null;

        return $result;
    }

    public static function create()
    {
        return self::of(null, null);
    }

    public function toJson(): array
    {
        return [
            'location' => $this->location,
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'warehouse_id' => $this->warehouseId,
            'is_default' => $this->isDefault,
            'batch' => $this->batch,
            'cost' => $this->cost,
        ];
    }

    /**
     * @param InventoryLevels $object
     * @return bool
     */
    public function equals($object): bool
    {
        return ($object instanceof InventoryLevels) &&
        ($this->location === $object->location) &&
        ($this->productId === $object->productId) &&
        ($this->quantity === $object->quantity) &&
        ($this->warehouseId === $object->warehouseId) &&
        ($this->batch === $object->batch) &&
        ($this->cost === $object->cost) &&
        ($this->isDefault === $object->isDefault);
    }

    public function withLocation(?string $location): self
    {
        $result = clone $this;
        $result->location = $location;
        return $result;
    }

    public function withProductId(int $productId): self
    {
        $result = clone $this;
        $result->productId = $productId;
        return $result;
    }

    public function withQuantity(?int $quantity): self
    {
        $result = clone $this;
        $result->quantity = $quantity;
        return $result;
    }

    public function withWarehouseId(int $warehouseId): self
    {
        $result = clone $this;
        $result->warehouseId = $warehouseId;
        return $result;
    }

    public function withIsDefault(bool $isDefault): self
    {
        $result = clone $this;
        $result->isDefault = $isDefault;
        return $result;
    }

    public function withBatch(?string $batch): self
    {
        $result = clone $this;
        $result->batch = $batch;
        return $result;
    }

    public function withCost(string $cost): self
    {
        $result = clone $this;
        $result->cost = $cost;
        return $result;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }
}
