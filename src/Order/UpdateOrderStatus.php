<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class UpdateOrderStatus
{
    public static function of(int $id): self
    {
        $order = new self($id);
        return $order;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['id']);
        $result->createPayment = $json['create_payment'] ?? null;
        $result->salesOrderId = $json['sales_order_id'] ?? null;
        $result->remark = $json['remark'] ?? null;
        $result->orderStatus = $json['order_status'] ?? null;
        $result->deliveryDate = $json['delivery_date'] ?? null;
        return $result;
    }

    public function toJson(): array
    {
        return array_filter([
            'id' => $this->id,
            'order_status' => $this->orderStatus,
            'delivery_date' => $this->deliveryDate,
            'remark' => $this->remark,
            'sales_order_id' => $this->salesOrderId,
            'create_payment' => $this->createPayment
        ]);
    }

    public function equals(UpdateOrderStatus $object): bool
    {
        return ($object instanceof UpdateOrderStatus) &&
        ($this->id === $object->id) &&
        ($this->orderStatus === $object->orderStatus) &&
        ($this->deliveryDate === $object->deliveryDate) &&
        ($this->remark === $object->remark) &&
        ($this->createPayment === $object->createPayment) &&
        ($this->salesOrderId === $object->salesOrderId);
    }

    private $id;
    private $createPayment;
    private $salesOrderId;
    private $orderStatus;
    private $deliveryDate;
    private $remark;

    private function __construct($id)
    {
        $this->id = $id;
    }

    public function getOrderStatus(): ?string
    {
        return $this->orderStatus;
    }

    public function withOrderStatus(?string $orderStatus): self
    {
        $result = clone $this;
        $result->orderStatus = $orderStatus;
        return $result;
    }

    public function withCreatePayment(?bool $createPayment): self
    {
        $result = clone $this;
        $result->createPayment = $createPayment;
        return $result;
    }

    public function getCreatePayment() :?bool
    {
        return $this->createPayment;
    }

    public function withDeliveryDate(?string $deliveryDate): self
    {
        $result = clone $this;
        $result->deliveryDate = $deliveryDate;
        return $result;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    public function withSalesOrderId(?array $salesOrderId): self
    {
        $result = clone $this;
        $result->salesOrderId = $salesOrderId;
        return $result;
    }

    public function getSalesOrderId(): ?array
    {
        return $this->salesOrderId;
    }

    public function withRemark($remark): self
    {
        $result = clone $this;
        $result->remark = $remark;
        return $result;
    }

    public function getRemark()
    {
        return $this->remark;
    }

    public function withId(int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
