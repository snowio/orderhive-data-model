<?php

namespace SnowIO\OrderHiveDataModel\Product;

class Warehouse
{
    public static function of(?int $warehouseId): self
    {
        $item = new self($warehouseId);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }


    public static function fromJson($json): self
    {
        return self::of($json['warehouse_id'] ?? null)
            ->withOnHandQuantity($json['on_hand_quantity'] ?? null)
            ->withRemark(Remark::of($json['remark']['source'] ?? null, $json['remark']['desc'] ?? null))
            ->withInventoryLevels(InventoryLevelsSet::fromJson($json['inventory_levels'] ?? []));
    }

    public function toJson(): array
    {
        return [
            'warehouse_id' => $this->warehouseId,
            'remark' => $this->remark->toJson(),
            'on_hand_quantity' => $this->onHandQuantity,
            'inventory_levels' => $this->inventoryLevels->toJson()
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Warehouse) &&
        ($this->onHandQuantity === $object->onHandQuantity) &&
        ($this->warehouseId === $object->warehouseId) &&
        ($this->remark->equals($object->remark)) &&
        ($this->inventoryLevels->equals($object->inventoryLevels));
    }

    private $warehouseId;
    private $remark;
    private $onHandQuantity;
    private $inventoryLevels;

    private function __construct(?int $warehouseId)
    {
        $this->warehouseId = $warehouseId;
        $this->inventoryLevels = InventoryLevelsSet::create();
    }

    public function withWarehouseId(?int $warehouseId): self
    {
        $result = clone $this;
        $result->warehouseId = $warehouseId;
        return $result;
    }

    public function getWarehouseId(): ?int
    {
        return $this->warehouseId;
    }

    public function withOnHandQuantity($onHandQuantity): self
    {
        $result = clone $this;
        $result->onHandQuantity = $onHandQuantity;
        return $result;
    }

    public function withRemark(Remark $remark): self
    {
        $result = clone $this;
        $result->remark = $remark;
        return $result;
    }

    public function withInventoryLevels(InventoryLevelsSet $inventoryLevels)
    {
        $result = clone $this;
        $result->inventoryLevels = $inventoryLevels;
        return $result;
    }

    public function getInventoryLevels(): InventoryLevelsSet
    {
        return $this->inventoryLevels;
    }
}
