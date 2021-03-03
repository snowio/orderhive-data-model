<?php

namespace SnowIO\OrderHiveDataModel\PurchaseOrder\Create;

class Supplier
{
    public static function of(?int $id, ?int $contactId): self
    {
        $item = new self($id, $contactId);
        return $item;
    }

    public static function create(): self
    {
        return new self(null, null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['id'] ?? null, $json['contact_id'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'contact_id' => $this->contactId
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Supplier) &&
        ($this->contactId === $object->contactId) &&
        ($this->id === $object->id);
    }

    private $id;
    private $contactId;

    private function __construct(?int $id, ?int $contactId)
    {
        $this->id = $id;
        $this->contactId = $contactId;
    }
}
