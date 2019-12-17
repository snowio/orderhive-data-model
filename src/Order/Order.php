<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class Order
{
    public static function of($referenceNumber): self
    {
        $order = new self($referenceNumber);
        $order->orderItems = ItemSet::create();
        return $order;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['reference_number']);
        $result->storeId = $json['store_id'] ?? null;
        $result->warehouseId = $json['warehouse_id'] ?? null;
        $result->taxType = $json['tax_type'] ?? null;
        $result->currency = $json['currency'] ?? null;
        $result->orderStatus = $json['order_status'] ?? null;
        $result->orderItems = ItemSet::fromJson($json['order_items'] ?? []);
        return $result;
    }

    public function getOrderType(): ?string
    {
        return $this->storeId;
    }

    public function withOrderType(string $storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    public function getOrderStatus(): ?string
    {
        return $this->orderStatus;
    }

    public function withOrderStatus(string $orderStatus): self
    {
        $result = clone $this;
        $result->orderStatus = $orderStatus;
        return $result;
    }

    public function getTaxType(): ?string
    {
        return $this->taxType;
    }

    public function withTaxType(string $taxType): self
    {
        $result = clone $this;
        $result->taxType = $taxType;
        return $result;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function withReferenceNumber(string $referenceNumber): self
    {
        $result = clone $this;
        $result->referenceNumber = $referenceNumber;
        return $result;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function withCurrency(string $currency): self
    {
        $result = clone $this;
        $result->currency = $currency;
        return $result;
    }

    public function getStoreId(): ?string
    {
        return $this->storeId;
    }

    public function withStoreId($storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    public function getOrderItems(): ?ItemSet
    {
        return $this->orderItems;
    }

    public function withOrderItems(ItemSet $orderItems): self
    {
        $result = clone $this;
        $result->orderItems = $orderItems;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'warehouse_id' => $this->warehouseId,
            'reference_number' => $this->referenceNumber,
            'currency' => $this->currency,
            'order_status' => $this->orderStatus,
            'store_id' => $this->storeId,
            'tax_type' => $this->taxType,
            'order_items' => $this->orderItems->toJson(),
            'shipping_address' => [],
            'billing_address' => [],
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Order) &&
        ($this->warehouseId === $object->warehouseId) &&
        ($this->referenceNumber === $object->referenceNumber) &&
        ($this->currency === $object->currency) &&
        ($this->orderStatus === $object->orderStatus) &&
        ($this->storeId === $object->storeId) &&
        ($this->taxType === $object->taxType) &&
        ($this->orderItems->equals($object->orderItems));
    }


    private $itemId;
    private $storeId;
    private $warehouseId;
    private $referenceNumber;
    private $taxType;
    private $currency;
    private $orderStatus;

    /** @var ItemSet */
    private $orderItems;

    private function __construct($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
    }
}
