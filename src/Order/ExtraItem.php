<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class ExtraItem
{
    public static function of($name): self
    {
        $item = (new self($name));
        $item->taxInfo = TaxInfo::create();
        return $item;
    }

    public static function fromJson($json): self
    {
        $result = self::of($json['name']);
        $result->price = $json['price'] ?? null;
        $result->quantityOrdered = $json['quantity_ordered'] ?? null;
        $result->rowTotal = $json['row_total'] ?? null;
        $result->type = $json['type'] ?? null;
        $result->updateType = $json['update_type'] ?? null;
        $result->taxPercent = $json['tax_percent'] ?? null;
        $result->taxValue = $json['tax_value'] ?? null;
        $result->taxInfo = $json['tax_info'] ?? null;

        return $result;
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'quantity_ordered' => $this->quantityOrdered,
            'row_total' => $this->rowTotal,
            'tax_info' => $this->taxInfo->toJson(),
            'tax_percent' => $this->taxPercent,
            'tax_value' => $this->taxValue,
            'update_type' => $this->updateType,
            'type' => $this->type
        ];
    }

    public function equals(ExtraItem $object): bool
    {
        return ($object instanceof Item) &&
        ($this->name === $object->name) &&
        ($this->price === $object->price) &&
        ($this->quantityOrdered === $object->quantityOrdered) &&
        ($this->rowTotal === $object->rowTotal) &&
        ($this->taxInfo->equals($object->taxInfo)) &&
        ($this->taxPercent === $object->taxPercent) &&
        ($this->taxValue === $object->taxValue) &&
        ($this->updateType === $object->updateType);
    }

    private $name;
    private $price;
    private $rowTotal;
    private $type;
    private $updateType;
    private $quantityOrdered;
    private $taxPercent;

    /** @var TaxInfo */
    private $taxInfo;
    private $taxValue;

    private function __construct($name)
    {
        $this->name = $name;
    }

    public function withName(string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function withPrice(?float $price): self
    {
        $result = clone $this;
        $result->price = $price;
        return $result;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function withQuantityOrdered($quantityOrdered): self
    {
        $result = clone $this;
        $result->quantityOrdered = $quantityOrdered;
        return $result;
    }

    public function getQuantityOrdered(): int
    {
        return $this->quantityOrdered;
    }

    public function withUpdateType($updateType): self
    {
        $result = clone $this;
        $result->updateType = $updateType;
        return $result;
    }

    public function getUpdateType()
    {
        return $this->updateType;
    }

    public function withType($type): self
    {
        $result = clone $this;
        $result->type = $type;
        return $result;
    }

    public function getType()
    {
        return $this->type;
    }

    public function withTaxValue($taxValue): self
    {
        $result = clone $this;
        $result->taxValue = $taxValue;
        return $result;
    }

    public function getTaxValue()
    {
        return $this->taxValue;
    }

    public function withTaxPercent(?float $taxPercent): self
    {
        $result = clone $this;
        $result->taxPercent = $taxPercent;
        return $result;
    }

    public function getTaxPercent(): ?float
    {
        return $this->taxPercent;
    }

    public function withTaxInfo(TaxInfo $taxInfo): self
    {
        $result = clone $this;
        $result->taxInfo = $taxInfo;
        return $result;
    }

    public function getTaxInfo(): TaxInfo
    {
        return $this->taxInfo;
    }

    public function withRowTotal(?float $rowTotal): self
    {
        $result = clone $this;
        $result->rowTotal = $rowTotal;
        return $result;
    }

    public function getRowTotal(): ?float
    {
        return $this->rowTotal;
    }

}
