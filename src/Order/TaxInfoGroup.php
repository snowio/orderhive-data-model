<?php

namespace SnowIO\OrderHiveDataModel\Order;

class TaxInfoGroup
{
    public static function of(?int $id): self
    {
        $item = new self($id);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['id'] ?? null)
            ->withName($json['name'] ?? null)
            ->withTotalTaxValue($json['total_tax_value'] ?? null)
            ->withTaxRate($json['tax_rate'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tax_rate' => $this->taxRate,
            'total_tax_value' => $this->totalTaxValue,
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof TaxInfoGroup) &&
        ($this->taxRate === $object->taxRate) &&
        ($this->name === $object->name) &&
        ($this->totalTaxValue === $object->totalTaxValue) &&
        ($this->id === $object->id);
    }

    private $id;
    private $taxRate;
    private $name;
    private $totalTaxValue;

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

    public function withTaxRate(?float $taxRate): self
    {
        $result = clone $this;
        $result->taxRate = $taxRate;
        return $result;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    public function withName(?string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function withTotalTaxValue(?float $totalTaxValue): self
    {
        $result = clone $this;
        $result->totalTaxValue = $totalTaxValue;
        return $result;
    }

    public function getTotalTaxValue(): ?float
    {
        return $this->totalTaxValue;
    }

}
