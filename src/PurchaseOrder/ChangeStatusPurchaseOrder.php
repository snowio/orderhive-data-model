<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\PurchaseOrder;

final class ChangeStatusPurchaseOrder
{
    public static function of(array $id, string $status): self
    {
        $po = new self($id, $status);
        return $po;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['id'], $json['status']);
        $result->status = $json['status'] ?? null;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status
        ];
    }

    public function equals(ChangeStatusPurchaseOrder $object): bool
    {
        return ($object instanceof ChangeStatusPurchaseOrder) &&
        ($this->id === $object->id) &&
        ($this->status === $object->status);
    }

    private $id;
    private $status;

    private function __construct($id, $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    public function withStatus(?string $status): self
    {
        $result = clone $this;
        $result->status = $status;
        return $result;
    }

    public function getStatus() :?string
    {
        return $this->status;
    }

    public function withId(array $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    public function getId(): array
    {
        return $this->id;
    }
}
