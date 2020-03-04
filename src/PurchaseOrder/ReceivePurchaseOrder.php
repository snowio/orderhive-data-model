<?php

namespace SnowIO\OrderHiveDataModel\PurchaseOrder;

class ReceivePurchaseOrder
{
    public static function of(?int $id): self
    {
        $item = new self($id);
        $item->purchaseOrderItems = PurchaseOrderItems::create();
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['id'] ?? null)
            ->withPurchaseOrderItems(PurchaseOrderItems::fromJson($json['purchaseOrderItems'] ?? []));
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'purchaseOrderItems' => $this->purchaseOrderItems->toJson()
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof ReceivePurchaseOrder) &&
        ($this->id === $object->id) &&
        ($this->purchaseOrderItems == $object->purchaseOrderItems);
    }

    private $id;
    private $purchaseOrderItems;

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

    public function withPurchaseOrderItems(PurchaseOrderItems $items): self
    {
        $result = clone $this;
        $result->purchaseOrderItems = $items;
        return $result;
    }

    public function getPurchaseOrderItems(): PurchaseOrderItems
    {
        return $this->purchaseOrderItems;
    }
}
