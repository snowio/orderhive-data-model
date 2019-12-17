<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class Item
{
    public static function of(int $orderItemId, int $stockNumber): self
    {
        $item = (new self($orderItemId, $stockNumber));
        return $item;
    }

    public static function fromJson($json): self
    {
        $result = self::of($json['item_id'], $json['quantity_ordered']);
        $result->asinNumber = $json['asin_number'] ?? null;
        $result->barcode = $json['barcode'] ?? null;
        $result->price = $json['price'] ?? null;
        $result->name = $json['name'] ?? null;
        $result->sku = $json['sku'] ?? null;
        $result->id = $json['id'] ?? null;

        return $result;
    }

    public function toJson(): array
    {
        return [
            'item_id' => $this->itemId,
            'asin_number' => $this->asinNumber,
            'barcode' => $this->barcode,
            'price' => $this->price,
            'sku' => $this->sku,
            'name' => $this->name,
            'quantity_ordered' => $this->quantityOrdered,
        ];
    }

    /**
     * @param Item $object
     * @return bool
     */
    public function equals($object): bool
    {
        return ($object instanceof Item) &&
        ($this->itemId === $object->itemId) &&
        ($this->asinNumber === $object->asinNumber) &&
        ($this->barcode === $object->barcode);
    }

    private $itemId;
    private $asinNumber;
    private $channelPrimaryId;
    private $referenceNumber;
    private $channelSecondaryId;
    private $components;
    private $barcode;
    private $discountPercent;
    private $discountType;
    private $discountValue;
    private $id;
    private $itemWarehouse;
    private $metaData;
    private $name;
    private $note;
    private $price;
    private $productImage;
    private $quantityOrdered;
    private $quantityInvoiced;
    private $rowTotal;
    private $sku;
    private $taxInfo;
    private $taxPercent;
    private $taxValue;
    private $updateType;
    private $weight;
    private $weightUnit;

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function withItemId(int $itemId): self
    {
        $result = clone $this;
        $result->itemId = $itemId;
        return $result;
    }

    private function __construct(int $itemId, int $quantityOrdered)
    {
        $this->itemId = $itemId;
        $this->quantityOrdered = $quantityOrdered;
    }

    /**
     * @param mixed $asinNumber
     * @return Item
     */
    public function withAsinNumber($asinNumber)
    {
        $result = clone $this;
        $result->asinNumber = $asinNumber;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getAsinNumber()
    {
        return $this->asinNumber;
    }

    /**
     * @param mixed $channelPrimaryId
     * @return Item
     */
    public function withChannelPrimaryId($channelPrimaryId)
    {
        $result = clone $this;
        $result->channelPrimaryId = $channelPrimaryId;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getChannelPrimaryId()
    {
        return $this->channelPrimaryId;
    }

    /**
     * @param mixed $referenceNumber
     * @return Item
     */
    public function withReferenceNumber($referenceNumber)
    {
        $result = clone $this;
        $result->referenceNumber = $referenceNumber;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param mixed $channelSecondaryId
     * @return Item
     */
    public function withChannelSecondaryId($channelSecondaryId)
    {
        $result = clone $this;
        $result->channelSecondaryId = $channelSecondaryId;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getChannelSecondaryId()
    {
        return $this->channelSecondaryId;
    }

    /**
     * @param mixed $components
     * @return Item
     */
    public function withComponents($components)
    {
        $result = clone $this;
        $result->components = $components;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param mixed $barcode
     * @return Item
     */
    public function withBarcode($barcode)
    {
        $result = clone $this;
        $result->barcode = $barcode;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param mixed $discountPercent
     * @return Item
     */
    public function withDiscountPercent($discountPercent)
    {
        $result = clone $this;
        $result->discountPercent = $discountPercent;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     * @param mixed $discountType
     * @return Item
     */
    public function withDiscountType($discountType)
    {
        $result = clone $this;
        $result->discountType = $discountType;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }

    /**
     * @param mixed $discountValue
     * @return Item
     */
    public function withDiscountValue($discountValue)
    {
        $result = clone $this;
        $result->discountValue = $discountValue;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getDiscountValue()
    {
        return $this->discountValue;
    }

    /**
     * @param mixed $id
     * @return Item
     */
    public function withId($id)
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $itemWarehouse
     * @return Item
     */
    public function withItemWarehouse($itemWarehouse)
    {
        $result = clone $this;
        $result->itemWarehouse = $itemWarehouse;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getItemWarehouse()
    {
        return $this->itemWarehouse;
    }

    /**
     * @param mixed $name
     * @return Item
     */
    public function withName($name)
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $sku
     * @return Item
     */
    public function withSku($sku)
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $price
     * @return Item
     */
    public function withPrice($price)
    {
        $result = clone $this;
        $result->price = $price;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $note
     * @return Item
     */
    public function withNote($note)
    {
        $result = clone $this;
        $result->note = $note;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $quantityInvoiced
     * @return Item
     */
    public function withQuantityInvoiced($quantityInvoiced)
    {
        $result = clone $this;
        $result->quantityInvoiced = $quantityInvoiced;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getQuantityInvoiced()
    {
        return $this->quantityInvoiced;
    }

}
