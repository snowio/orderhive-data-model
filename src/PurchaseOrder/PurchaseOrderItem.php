<?php

namespace SnowIO\OrderHiveDataModel\PurchaseOrder;

class PurchaseOrderItem
{
    public static function of(?int $id): self
    {
        $item = new self($id);
        $item->warehouseLocation = WarehouseLocations::create();
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['id'] ?? null)
            ->withItemId($json['itemId'])
            ->withQtyReceived($json['qtyReceived'])
            ->withWarehouseLocation(
                WarehouseLocations::fromJson($json['warehouse_location'])
            );
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'itemId' => $this->itemId,
            'qtyReceived' => $this->qtyReceived,
            'warehouse_location' => $this->warehouseLocation->toJson()
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof PurchaseOrderItem) &&
        ($this->id === $object->id) &&
        ($this->qtyReceived === $object->qtyReceived) &&
        ($this->warehouseLocation === $object->warehouseLocation) &&
        ($this->itemId == $object->itemId);
    }

    private $id;
    private $itemId;
    private $qtyReceived = 0;
    /** @var WarehouseLocations */
    private $warehouseLocation;

    private function __construct(?int $id)
    {
        $this->id = $id;
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

    public function withItemId(?int $itemId): self
    {
        $result = clone $this;
        $result->itemId = $itemId;
        return $result;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function withQtyReceived(?int $qtyReceived): self
    {
        $result = clone $this;
        $result->qtyReceived = $qtyReceived;
        return $result;
    }

    public function getQtyReceived(): ?int
    {
        return $this->qtyReceived;
    }

    public function withWarehouseLocation(WarehouseLocations $warehouseLocation): self
    {
        $result = clone $this;
        $result->warehouseLocation = $warehouseLocation;
        return $result;
    }

    public function getWarehouseLocation(): WarehouseLocations
    {
        return $this->warehouseLocation;
    }
}
