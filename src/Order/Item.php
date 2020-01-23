<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class Item
{
    public static function of($itemId, int $quantityOrdered): self
    {
        $item = (new self($itemId, $quantityOrdered));
        $item->productImage = ProductImage::create();
        $item->taxInfo = TaxInfo::create();
        return $item;
    }

    public static function fromJson($json): self
    {
        $result = self::of($json['item_id'], $json['quantity_ordered']);
        $result->asinNumber = $json['asin_number'] ?? null;
        $result->channelPrimaryId = $json['channel_primary_id'] ?? null;
        $result->referenceNumber = $json['reference_number'] ?? null;
        $result->channelSecondaryId = $json['channel_secondary_id'] ?? null;
        $result->components = $json['components'] ?? null;
        $result->barcode = $json['barcode'] ?? null;
        $result->discountPercent = $json['discount_percent'] ?? null;
        $result->discountType = $json['discount_type'] ?? null;
        $result->discountValue = $json['discount_value'] ?? null;
        $result->id = $json['id'] ?? null;
        $result->itemWarehouse = $json['item_warehouse'] ?? null;
        $result->metaData = $json['meta_data'] ?? null;
        $result->name = $json['name'] ?? null;
        $result->note = $json['note'] ?? null;
        $result->price = $json['price'] ?? null;
        $result->productImage = ProductImage::fromJson($json['product_image'] ?? []);
        $result->quantityInvoiced = $json['quantity_invoiced'] ?? null;
        $result->rowTotal = $json['row_total'] ?? null;
        $result->sku = $json['sku'] ?? null;
        $result->taxInfo = TaxInfo::fromJson($json['tax_info'] ?? []);
        $result->taxPercent = $json['tax_percent'] ?? null;
        $result->taxValue = $json['tax_value'] ?? null;
        $result->updateType = $json['update_type'] ?? null;
        $result->weight = $json['weight'] ?? null;
        $result->weightUnit = $json['weight_unit'] ?? null;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'item_id' => $this->itemId,
            'asin_number' => $this->asinNumber,
            'channel_primary_id' => $this->channelPrimaryId,
            'reference_number' => $this->referenceNumber,
            'channel_secondary_id' => $this->channelSecondaryId,
            'components' => $this->components,
            'barcode' => $this->barcode,
            'discount_percent' => $this->discountPercent,
            'discount_type' => $this->discountType,
            'discount_value' => $this->discountValue,
            'id' => $this->id,
            'item_warehouse' => $this->itemWarehouse,
            'meta_data' => $this->metaData,
            'name' => $this->name,
            'note' => $this->note,
            'price' => $this->price,
            'product_image' => $this->productImage->toJson(),
            'quantity_ordered' => $this->quantityOrdered,
            'quantity_invoiced' => $this->quantityInvoiced,
            'row_total' => $this->rowTotal,
            'sku' => $this->sku,
            'tax_info' => $this->taxInfo->toJson(),
            'tax_percent' => $this->taxPercent,
            'tax_value' => $this->taxValue,
            'update_type' => $this->updateType,
            'weight' => $this->weight,
            'weight_unit' => $this->weightUnit
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
        ($this->channelPrimaryId === $object->channelPrimaryId) &&
        ($this->referenceNumber === $object->referenceNumber) &&
        ($this->channelSecondaryId === $object->channelSecondaryId) &&
        ($this->components === $object->components) &&
        ($this->barcode === $object->barcode) &&
        ($this->discountPercent === $object->discountPercent) &&
        ($this->discountType === $object->discountType) &&
        ($this->discountValue === $object->discountValue) &&
        ($this->id === $object->id) &&
        ($this->itemWarehouse === $object->itemWarehouse) &&
        ($this->metaData === $object->metaData) &&
        ($this->name === $object->name) &&
        ($this->note === $object->note) &&
        ($this->price === $object->price) &&
        ($this->productImage->equals($object->productImage)) &&
        ($this->quantityOrdered === $object->quantityOrdered) &&
        ($this->quantityInvoiced === $object->quantityInvoiced) &&
        ($this->rowTotal === $object->rowTotal) &&
        ($this->sku === $object->sku) &&
        ($this->taxInfo->equals($object->taxInfo)) &&
        ($this->taxPercent === $object->taxPercent) &&
        ($this->taxValue === $object->taxValue) &&
        ($this->updateType === $object->updateType) &&
        ($this->weight === $object->weight) &&
        ($this->weightUnit === $object->weightUnit) &&
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

    public function getItemId()
    {
        return $this->itemId;
    }

    public function withItemId(string $itemId): self
    {
        $result = clone $this;
        $result->itemId = $itemId;
        return $result;
    }

    private function __construct($itemId, $quantityOrdered)
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
     * @param string $referenceNumber
     * @return Item
     */
    public function withReferenceNumber(?string $referenceNumber)
    {
        $result = clone $this;
        $result->referenceNumber = $referenceNumber;
        return $result;
    }

    /**
     * @return string|null
     */
    public function getReferenceNumber():?string
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
     * @param string $barcode
     * @return Item
     */
    public function withBarcode(string $barcode): self
    {
        $result = clone $this;
        $result->barcode = $barcode;
        return $result;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param float $discountPercent
     * @return Item
     */
    public function withDiscountPercent(?float $discountPercent): self
    {
        $result = clone $this;
        $result->discountPercent = $discountPercent;
        return $result;
    }

    /**
     * @return float
     */
    public function getDiscountPercent(): ?float
    {
        return $this->discountPercent;
    }

    /**
     * @param float $discountType
     * @return Item
     */
    public function withDiscountType($discountType): self
    {
        $result = clone $this;
        $result->discountType = $discountType;
        return $result;
    }

    /**
     * @return float
     */
    public function getDiscountType(): float
    {
        return $this->discountType;
    }

    /**
     * @param float|null $discountValue
     * @return Item
     */
    public function withDiscountValue(?float $discountValue): self
    {
        $result = clone $this;
        $result->discountValue = $discountValue;
        return $result;
    }

    /**
     * @return float|null
     */
    public function getDiscountValue(): ?float
    {
        return $this->discountValue;
    }

    /**
     * @param int|null $id
     * @return Item
     */
    public function withId(?int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    /**
     * @return int|nul
     */
    public function getId(): ?int
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
     * @param string $name
     * @return Item
     */
    public function withName(string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $sku
     * @return Item
     */
    public function withSku(string $sku): self
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param float|null $price
     * @return Item
     */
    public function withPrice(?float $price): self
    {
        $result = clone $this;
        $result->price = $price;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param mixed $note
     * @return Item
     */
    public function withNote($note): self
    {
        $result = clone $this;
        $result->note = $note;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param mixed $quantityInvoiced
     * @return Item
     */
    public function withQuantityInvoiced($quantityInvoiced): self
    {
        $result = clone $this;
        $result->quantityInvoiced = $quantityInvoiced;
        return $result;
    }

    /**
     * @return int
     */
    public function getQuantityInvoiced(): int
    {
        return $this->quantityInvoiced;
    }

    /**
     * @return int
     */
    public function getQuantityOrdered(): int
    {
        return $this->quantityOrdered;
    }

    /**
     * @param string $weightUnit
     * @return Item
     */
    public function withWeightUnit(string $weightUnit): self
    {
        $result = clone $this;
        $result->weightUnit = $weightUnit;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getWeightUnit()
    {
        return $this->weightUnit;
    }

    /**
     * @param float $weight
     * @return Item
     */
    public function withWeight(float $weight): self
    {
        $result = clone $this;
        $result->weight = $weight;
        return $result;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param mixed $updateType
     * @return Item
     */
    public function withUpdateType($updateType): self
    {
        $result = clone $this;
        $result->updateType = $updateType;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getUpdateType()
    {
        return $this->updateType;
    }

    /**
     * @param mixed $taxValue
     * @return Item
     */
    public function withTaxValue($taxValue): self
    {
        $result = clone $this;
        $result->taxValue = $taxValue;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getTaxValue()
    {
        return $this->taxValue;
    }

    /**
     * @param float|null $taxPercent
     * @return Item
     */
    public function withTaxPercent(?float $taxPercent): self
    {
        $result = clone $this;
        $result->taxPercent = $taxPercent;
        return $result;
    }

    /**
     * @return float|null
     */
    public function getTaxPercent(): ?float
    {
        return $this->taxPercent;
    }

    /**
     * @param TaxInfo $taxInfo
     * @return Item
     */
    public function withTaxInfo(TaxInfo $taxInfo): self
    {
        $result = clone $this;
        $result->taxInfo = $taxInfo;
        return $result;
    }

    /**
     * @return TaxInfo
     */
    public function getTaxInfo(): TaxInfo
    {
        return $this->taxInfo;
    }

    /**
     * @param float|null $rowTotal
     * @return Item
     */
    public function withRowTotal(?float $rowTotal): self
    {
        $result = clone $this;
        $result->rowTotal = $rowTotal;
        return $result;
    }

    /**
     * @return float|null
     */
    public function getRowTotal(): ?float
    {
        return $this->rowTotal;
    }

    /**
     * @param ProductImage $productImage
     * @return Item
     */
    public function withProductImage(ProductImage $productImage): self
    {
        $result = clone $this;
        $result->productImage = $productImage;
        return $result;
    }

    /**
     * @return ProductImage
     */
    public function getProductImage(): ProductImage
    {
        return $this->productImage;
    }

    /**
     * @param mixed $metaData
     * @return Item
     */
    public function withMetaData($metaData): self
    {
        $result = clone $this;
        $result->metaData = $metaData;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

}
