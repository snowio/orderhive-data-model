<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order\OrderDetails;

class ExtraItem
{
    public static function of($id): self
    {
        $item = (new self($id));
        return $item;
    }

    public static function fromJson($json): self
    {
        $result = self::of($json['id']);
        $result->name = $json['name'] ?? null;
        $result->price = $json['price'] ?? null;
        $result->quantityOrdered = $json['quantity_ordered'] ?? 0;
        $result->quantityCancelled = $json['quantity_cancelled'] ?? 0;
        $result->quantityShipped = $json['quantity_shipped'] ?? 0;
        $result->quantityAvailable = $json['quantity_available'] ?? 0;
        $result->quantityInvoiced = $json['quantity_invoiced'] ?? 0;
        $result->quantityPacked = $json['quantity_packed'] ?? 0;
        $result->quantityDropShip = $json['quantity_dropship'] ?? 0;
        $result->rowTotal = $json['row_total'] ?? null;
        $result->type = $json['type'] ?? null;
        $result->taxPercent = $json['tax_percent'] ?? null;
        $result->taxValue = $json['tax_value'] ?? null;
        $result->displayType = $json['display_type'] ?? null;

        return $result;
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity_ordered' => $this->quantityOrdered,
            'quantity_cancelled' => $this->quantityCancelled,
            'quantity_shipped' => $this->quantityShipped,
            'quantity_available' => $this->quantityAvailable,
            'quantity_invoiced' => $this->quantityInvoiced,
            'quantity_packed' => $this->quantityPacked,
            'quantity_dropship' => $this->quantityDropShip,
            'row_total' => $this->rowTotal,
            'tax_percent' => $this->taxPercent,
            'tax_value' => $this->taxValue,
            'display_type' => $this->displayType,
            'type' => $this->type
        ];
    }

    public function equals(ExtraItem $object): bool
    {
        return ($object instanceof Item) &&
        ($this->id === $object->id) &&
        ($this->name === $object->name) &&
        ($this->price === $object->price) &&
        ($this->quantityOrdered === $object->quantityOrdered) &&
        ($this->quantityCancelled === $object->quantityCancelled) &&
        ($this->quantityShipped === $object->quantityShipped) &&
        ($this->quantityAvailable === $object->quantityAvailable) &&
        ($this->quantityInvoiced === $object->quantityInvoiced) &&
        ($this->quantityPacked === $object->quantityPacked) &&
        ($this->quantityDropShip === $object->quantityDropShip) &&
        ($this->rowTotal === $object->rowTotal) &&
        ($this->taxPercent === $object->taxPercent) &&
        ($this->taxValue === $object->taxValue) &&
        ($this->displayType === $object->displayType);
    }

    private $id;
    private $name;
    private $price;
    private $rowTotal;
    private $type;
    private $quantityOrdered;
    private $quantityCancelled;
    private $quantityShipped;
    private $quantityAvailable;
    private $quantityInvoiced;
    private $quantityDropShip;
    private $quantityPacked;
    private $taxPercent;
    private $displayType;
    private $taxValue;

    private function __construct($id)
    {
        $this->id = $id;
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

    public function withQuantityCancelled($quantityCancelled): self
    {
        $result = clone $this;
        $result->quantityCancelled = $quantityCancelled;
        return $result;
    }

    public function getQuantityCancelled(): int
    {
        return $this->quantityCancelled;
    }

    public function withQuantityShipped($quantityShipped): self
    {
        $result = clone $this;
        $result->quantityShipped = $quantityShipped;
        return $result;
    }

    public function getQuantityShipped(): int
    {
        return $this->quantityShipped;
    }

    public function withQuantityAvailable($quantityAvailable): self
    {
        $result = clone $this;
        $result->quantityAvailable = $quantityAvailable;
        return $result;
    }

    public function getQuantityAvailable(): int
    {
        return $this->quantityAvailable;
    }

    public function withQuantityInvoiced($quantityInvoiced): self
    {
        $result = clone $this;
        $result->quantityInvoiced = $quantityInvoiced;
        return $result;
    }

    public function getQuantityInvoiced(): int
    {
        return $this->quantityInvoiced;
    }

    public function withQuantityPacked($quantityPacked): self
    {
        $result = clone $this;
        $result->quantityPacked = $quantityPacked;
        return $result;
    }

    public function getQuantityPacked(): int
    {
        return $this->quantityPacked;
    }

    public function withQuantityDropShip($quantityDropShip): self
    {
        $result = clone $this;
        $result->quantityDropShip = $quantityDropShip;
        return $result;
    }

    public function getQuantityDropShip(): int
    {
        return $this->quantityDropShip;
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

    public function withDisplayType(?string $displayType): self
    {
        $result = clone $this;
        $result->displayType = $displayType;
        return $result;
    }

    public function getDisplayType(): ?string
    {
        return $this->displayType;
    }

}
