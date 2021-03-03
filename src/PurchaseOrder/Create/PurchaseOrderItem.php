<?php

namespace SnowIO\OrderHiveDataModel\PurchaseOrder\Create;

class PurchaseOrderItem
{
    public static function of(?string $sku): self
    {
        $item = new self($sku);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['sku'] ?? null)
            ->withItemId($json['itemId'])
            ->withQtyOrdered($json['qtyOrdered'])
            ->withName($json['name'])
            ->withTaxPercent($json['tax_percent'])
            ->withBuyPrice($json['buy_price'])
            ->withBarcode($json['barcode']);
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'itemId' => $this->itemId,
            'qtyOrdered' => $this->qtyOrdered,
            'tax_percent' => $this->taxPercent,
            'buy_price' => $this->buyPrice,
            'barcode' => $this->barcode,
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof PurchaseOrderItem) &&
        ($this->name === $object->name) &&
        ($this->sku === $object->sku) &&
        ($this->itemId === $object->itemId) &&
        ($this->qtyOrdered === $object->qtyOrdered) &&
        ($this->taxPercent === $object->taxPercent) &&
        ($this->buyPrice === $object->buyPrice) &&
        ($this->barcode == $object->barcode);
    }

    private $name;
    private $sku;
    private $itemId;
    private $qtyOrdered;
    private $taxPercent;
    private $buyPrice;
    private $barcode;

    private function __construct(?string $sku)
    {
        $this->sku = $sku;
    }

    public function withSku(?string $sku): self
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    public function getSku(): ?string
    {
        return $this->sku;
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

    public function withItemId(?int $itemId): self
    {
        $result = clone $this;
        $result->itemId = $itemId;
        return $result;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function withQtyOrdered(?int $qty): self
    {
        $result = clone $this;
        $result->qtyOrdered = $qty;
        return $result;
    }

    public function getQtyOrdered(): ?int
    {
        return $this->qtyOrdered;
    }

    public function withTaxPercent(?float $tax): self
    {
        $result = clone $this;
        $result->taxPercent = $tax;
        return $result;
    }

    public function getTaxPercent(): ?float
    {
        return $this->taxPercent;
    }

    public function withBuyPrice(?string $buyPrice): self
    {
        $result = clone $this;
        $result->buyPrice = $buyPrice;
        return $result;
    }

    public function getBuyPrice(): ?string
    {
        return $this->buyPrice;
    }

    public function withBarcode(?string $barcode): self
    {
        $result = clone $this;
        $result->barcode = $barcode;
        return $result;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }
}
