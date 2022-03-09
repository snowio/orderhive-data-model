<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Shipment\Create;

class Item
{
    private $json;

    public static function create(): self
    {
        return new self;
    }

    public static function fromJson(array $json): self
    {
        $result = new self;
        $result->json = $json;
        return $result;
    }

    public function withItemId(int $itemId): self
    {
        $result = clone $this;
        $result->json['item_id'] = $itemId;
        return $result;
    }

    public function withQuantityToShip(int $quantityToShip): self
    {
        $result = clone $this;
        $result->json['quantity_to_ship'] = $quantityToShip;
        return $result;
    }

    public function withSku(string $sku): self
    {
        $result = clone $this;
        $result->json['sku'] = $sku;
        return $result;
    }

    public function withSalesOrderItemId(int $salesOrderItemId): self
    {
        $result = clone $this;
        $result->json['sales_order_item_id'] = $salesOrderItemId;
        return $result;
    }

    public function getItemId(): int
    {
        return $this->json['item_id'];
    }

    public function getQuantityToShip(): int
    {
        return $this->json['quantity_to_ship'];
    }

    public function getSku(): string
    {
        return $this->json['sku'];
    }

    public function getSalesOrderItemId(): int
    {
        return $this->json['sales_order_item_id'];
    }

    public function equals($other): bool
    {
        return $other instanceof self && $this->json === $other->json;
    }

    public function toJson(): array
    {
        return $this->json;
    }

    private function __construct()
    {
    }
}
