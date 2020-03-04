<?php

namespace SnowIO\OrderHiveDataModel\PurchaseOrder;

class WarehouseLocation
{
    public static function of(?string $batch): self
    {
        $item = new self($batch);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['batch'] ?? null)
            ->withLocation($json['location'])
            ->withQuantity($json['quantity'])
            ->withCost($json['cost']);
    }

    public function toJson(): array
    {
        return [
            'batch' => $this->batch,
            'location' => $this->location,
            'quantity' => $this->quantity,
            'cost' => $this->cost
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof WarehouseLocation) &&
        ($this->batch === $object->batch) &&
        ($this->location === $object->location) &&
        ($this->quantity === $object->quantity) &&
        ($this->cost == $object->cost);
    }

    private $batch;
    private $location;
    private $quantity = 0;
    private $cost;

    private function __construct(?string $batch)
    {
        $this->batch = $batch;
    }

    public function withBatch(?string $batch): self
    {
        $result = clone $this;
        $result->batch = $batch;
        return $result;
    }

    public function getBatch(): ?string
    {
        return $this->batch;
    }

    public function withLocation(?string $location): self
    {
        $result = clone $this;
        $result->location = $location;
        return $result;
    }

    public function getLocation(): ?string
    {
        return $this->location;
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

    public function withCost(?float $cost): self
    {
        $result = clone $this;
        $result->cost = $cost;
        return $result;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }
}
