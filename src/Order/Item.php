<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class Item
{
    public static function of($orderItemId, $stockNumber): self
    {
        $item = (new self($orderItemId, $stockNumber));
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
        $result->productImage = $json['product_image'] ?? null;
        $result->quantityInvoiced = $json['quantity_invoiced'] ?? null;
        $result->rowTotal = $json['row_total'] ?? null;
        $result->sku = $json['sku'] ?? null;
        $result->taxInfo = $json['tax_info'] ?? null;
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
            'product_image' => $this->productImage,
            'quantity_ordered' => $this->quantityOrdered,
            'quantity_invoiced' => $this->quantityInvoiced,
            'row_total' => $this->rowTotal,
            'sku' => $this->sku,
            'tax_info' => $this->taxInfo,
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
        ($this->productImage === $object->productImage) &&
        ($this->quantityOrdered === $object->quantityOrdered) &&
        ($this->quantityInvoiced === $object->quantityInvoiced) &&
        ($this->rowTotal === $object->rowTotal) &&
        ($this->sku === $object->sku) &&
        ($this->taxInfo === $object->taxInfo) &&
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

    /**
     * @param mixed $weightUnit
     * @return Item
     */
    public function withWeightUnit($weightUnit)
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
     * @param mixed $weight
     * @return Item
     */
    public function withWeight($weight)
    {
        $result = clone $this;
        $result->weight = $weight;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $updateType
     * @return Item
     */
    public function withUpdateType($updateType)
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
    public function withTaxValue($taxValue)
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
     * @param mixed $taxPercent
     * @return Item
     */
    public function withTaxPercent($taxPercent)
    {
        $result = clone $this;
        $result->taxPercent = $taxPercent;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getTaxPercent()
    {
        return $this->taxPercent;
    }

    /**
     * @param mixed $taxInfo
     * @return Item
     */
    public function withTaxInfo($taxInfo)
    {
        $result = clone $this;
        $result->taxInfo = $taxInfo;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getTaxInfo()
    {
        return $this->taxInfo;
    }

    /**
     * @param mixed $rowTotal
     * @return Item
     */
    public function withRowTotal($rowTotal)
    {
        $result = clone $this;
        $result->rowTotal = $rowTotal;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getRowTotal()
    {
        return $this->rowTotal;
    }

    /**
     * @param mixed $productImage
     * @return Item
     */
    public function withProductImage($productImage)
    {
        $result = clone $this;
        $result->productImage = $productImage;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     * @param mixed $metaData
     * @return Item
     */
    public function withMetaData($metaData)
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
