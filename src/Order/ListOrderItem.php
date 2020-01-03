<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class ListOrderItem
{
    public static function of($id): self
    {
        $item = (new self($id));
        return $item;
    }

    public static function fromJson($json): self
    {
        $result = self::of($json['id']);
        $result->id = $json['id'] ?? null;
        $result->name = $json['name'] ?? null;
        $result->itemId = $json['item_id'] ?? null;
        $result->sku = $json['sku'] ?? null;
        $result->discountPercent = $json['discount_percent'] ?? null;
        $result->discountValue = $json['discount_value'] ?? null;
        $result->quantityOrdered = $json['quantity_ordered'] ?? null;
        $result->quantityShipped = $json['quantity_shipped'] ?? null;
        $result->itemPrice = $json['item_price'] ?? null;
        $result->rowTotal = $json['row_total'] ?? null;
        $result->discountPercent = $json['discount_percent'] ?? null;
        $result->discountValue = $json['discount_value'] ?? null;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'item_id' => $this->itemId,
            'sku' => $this->sku,
            'quantity_ordered' => $this->quantityOrdered,
            'quantity_shipped' => $this->quantityShipped,
            'item_price' => $this->itemPrice,
            'row_total' => $this->rowTotal,
            'discount_percent' => $this->discountPercent,
            'discount_value' => $this->discountValue,
        ];
    }

    /**
     * @param ListOrderItem $object
     * @return bool
     */
    public function equals(ListOrderItem $object): bool
    {
        return ($object instanceof Item) &&
        ($this->id === $object->id) &&
        ($this->name === $object->name) &&
        ($this->itemId === $object->itemId) &&
        ($this->sku === $object->sku) &&
        ($this->quantityOrdered === $object->quantityOrdered) &&
        ($this->quantityShipped === $object->quantityShipped) &&
        ($this->itemPrice === $object->itemPrice) &&
        ($this->rowTotal === $object->rowTotal) &&
        ($this->discountPercent === $object->discountPercent) &&
        ($this->discountValue === $object->discountValue);
    }

    private $id;
    private $name;
    private $itemId;
    private $sku;
    private $quantityOrdered;
    private $quantityShipped;
    private $itemPrice;
    private $rowTotal;
    private $discountPercent;
    private $discountValue;

    private function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param int $id
     * @return ListOrderItem
     */
    public function withId(int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string|null $name
     * @return ListOrderItem
     */
    public function withName(?string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param int $itemId
     * @return ListOrderItem
     */
    public function withItemId(int $itemId): self
    {
        $result = clone $this;
        $result->itemId = $itemId;
        return $result;
    }

    /**
     * @return int
     */
    public function getItemId(): int
    {
        return $this->itemId;
    }

    /**
     * @param string $sku
     * @return ListOrderItem
     */
    public function withSku(string $sku): self
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param int $quantityOrdered
     * @return ListOrderItem
     */
    public function withQuantityOrdered(int $quantityOrdered): self
    {
        $result = clone $this;
        $result->quantityOrdered = $quantityOrdered;
        return $result;
    }

    /**
     * @return int
     */
    public function getQuantityOrdered(): int
    {
        return $this->quantityOrdered;
    }

    /**
     * @param int $quantityShipped
     * @return ListOrderItem
     */
    public function withQuantityShipped(int $quantityShipped): self
    {
        $result = clone $this;
        $result->quantityShipped = $quantityShipped;
        return $result;
    }

    /**
     * @return int
     */
    public function getQuantityShipped(): int
    {
        return $this->quantityShipped;
    }

    /**
     * @param float $itemPrice
     * @return ListOrderItem
     */
    public function withItemPrice(float $itemPrice): self
    {
        $result = clone $this;
        $result->itemPrice = $itemPrice;
        return $result;
    }

    /**
     * @return float
     */
    public function getItemPrice(): float
    {
        return $this->itemPrice;
    }

    /**
     * @param float $rowTotal
     * @return ListOrderItem
     */
    public function withRowTotal(float $rowTotal): self
    {
        $result = clone $this;
        $result->rowTotal = $rowTotal;
        return $result;
    }

    /**
     * @return float
     */
    public function getRowTotal(): float
    {
        return $this->rowTotal;
    }

    /**
     * @param float $discountPercent
     * @return ListOrderItem
     */
    public function withDiscountPercent(float $discountPercent): self
    {
        $result = clone $this;
        $result->discountPercent = $discountPercent;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercent(): float
    {
        return $this->discountPercent;
    }

    /**
     * @param float $discountValue
     * @return ListOrderItem
     */
    public function withDiscountValue(float $discountValue): self
    {
        $result = clone $this;
        $result->discountValue = $discountValue;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getDiscountValue(): float
    {
        return $this->discountValue;
    }

}
