<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order\OrderDetails;

use SnowIO\OrderHiveDataModel\Order\ProductImage;
use SnowIO\OrderHiveDataModel\Order\TaxInfo;

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
        $result->channelSecondaryId = $json['channel_secondary_id'] ?? null;
        $result->components = $json['components'] ?? null;
        $result->barcode = $json['barcode'] ?? null;
        $result->discountPercent = $json['discount_percent'] ?? null;
        $result->discountType = $json['discount_type'] ?? null;
        $result->discountValue = (float) $json['discount_value'] ?? null;
        $result->id = $json['id'] ?? null;
        $result->itemWarehouse = $json['item_warehouse'] ?? null;
        $result->metaData = $json['meta_data'] ?? null;
        $result->name = $json['name'] ?? null;
        $result->note = $json['note'] ?? null;
        $result->price = $json['price'] ?? null;
        $result->productImage = ProductImage::fromJson($json['product_image'] ?? []);
        $result->quantityInvoiced = $json['quantity_invoiced'] ?? null;
        $result->quantityCancelled = $json['quantity_cancelled'] ?? 0;
        $result->quantityShipped = $json['quantity_shipped'] ?? 0;
        $result->quantityOnHand = $json['quantity_on_hand'] ?? 0;
        $result->quantityAvailable = $json['quantity_available'] ?? 0;
        $result->quantityReturned = $json['quantity_returned'] ?? 0;
        $result->quantityDelivered = $json['quantity_delivered'] ?? 0;
        $result->quantityPacked = $json['quantity_packed'] ?? 0;
        $result->quantityDropShipped = $json['quantity_dropshipped'] ?? 0;
        $result->rowTotal = $json['row_total'] ?? null;
        $result->sku = $json['sku'] ?? null;
        $result->taxInfo = TaxInfo::fromJson($json['tax_info'] ?? []);
        $result->taxPercent = $json['tax_percent'] ?? null;
        $result->taxValue = $json['tax_value'] ?? null;
        $result->lastPurchasePrice = $json['last_purchase_price'] ?? null;
        $result->weight = $json['weight'] ?? null;
        $result->brand = $json['brand'] ?? null;
        $result->category = $json['category'] ?? null;
        $result->defaultSupplierId = $json['default_supplier_id'] ?? null;
        $result->type = $json['type'] ?? null;
        $result->suppliers = $json['suppliers'] ?? [];
        $result->serialNumbers = $json['serial_numbers'] ?? null;
        $result->weightUnit = $json['weight_unit'] ?? null;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'item_id' => $this->itemId,
            'asin_number' => $this->asinNumber,
            'channel_primary_id' => $this->channelPrimaryId,
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
            'quantity_cancelled' => $this->quantityCancelled,
            'quantity_shipped' => $this->quantityShipped,
            'quantity_available' => $this->quantityAvailable,
            'quantity_on_hand' => $this->quantityOnHand,
            'quantity_returned' => $this->quantityReturned,
            'quantity_delivered' => $this->quantityDelivered,
            'quantity_packed' => $this->quantityPacked,
            'quantity_dropshipped' => $this->quantityDropShipped,
            'row_total' => $this->rowTotal,
            'last_purchase_price' => $this->lastPurchasePrice,
            'sku' => $this->sku,
            'tax_info' => $this->taxInfo->toJson(),
            'tax_percent' => $this->taxPercent,
            'tax_value' => $this->taxValue,
            'weight' => $this->weight,
            'brand' => $this->brand,
            'category' => $this->category,
            'default_supplier_id' => $this->defaultSupplierId,
            'type' => $this->type,
            'suppliers' => $this->suppliers,
            'serial_numbers' => $this->serialNumbers,
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
        ($this->quantityCancelled === $object->quantityCancelled) &&
        ($this->rowTotal === $object->rowTotal) &&
        ($this->sku === $object->sku) &&
        ($this->taxInfo->equals($object->taxInfo)) &&
        ($this->taxPercent === $object->taxPercent) &&
        ($this->taxValue === $object->taxValue) &&
        ($this->lastPurchasePrice === $object->lastPurchasePrice) &&
        ($this->weight === $object->weight) &&
        ($this->weightUnit === $object->weightUnit) &&
        ($this->asinNumber === $object->asinNumber) &&
        ($this->category === $object->category) &&
        ($this->brand === $object->brand) &&
        ($this->defaultSupplierId === $object->defaultSupplierId) &&
        ($this->type === $object->type) &&
        ($this->serialNumbers === $object->serialNumbers) &&
        ($this->suppliers === $object->suppliers) &&
        ($this->barcode === $object->barcode);
    }

    private $itemId;
    private $asinNumber;
    private $channelPrimaryId;
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
    private $quantityOrdered = 0;
    private $quantityInvoiced = 0;
    private $quantityCancelled = 0;
    private $quantityShipped = 0;
    private $quantityAvailable = 0;
    private $quantityOnHand = 0;
    private $quantityReturned = 0;
    private $quantityDelivered = 0;
    private $quantityPacked = 0;
    private $quantityDropShipped = 0;
    private $rowTotal;
    private $sku;
    private $taxInfo;
    private $taxPercent;
    private $taxValue;
    private $weight;
    private $weightUnit;
    private $lastPurchasePrice;
    private $brand;
    private $category;
    private $defaultSupplierId;
    private $type;
    private $suppliers = [];
    private $serialNumbers;

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

    public function withAsinNumber($asinNumber): self
    {
        $result = clone $this;
        $result->asinNumber = $asinNumber;
        return $result;
    }

    public function getAsinNumber()
    {
        return $this->asinNumber;
    }

    public function withChannelPrimaryId($channelPrimaryId): self
    {
        $result = clone $this;
        $result->channelPrimaryId = $channelPrimaryId;
        return $result;
    }

    public function getChannelPrimaryId()
    {
        return $this->channelPrimaryId;
    }

    public function withChannelSecondaryId($channelSecondaryId): self
    {
        $result = clone $this;
        $result->channelSecondaryId = $channelSecondaryId;
        return $result;
    }

    public function getChannelSecondaryId()
    {
        return $this->channelSecondaryId;
    }

    public function withComponents($components): self
    {
        $result = clone $this;
        $result->components = $components;
        return $result;
    }

    public function getComponents()
    {
        return $this->components;
    }

    public function withBarcode(string $barcode): self
    {
        $result = clone $this;
        $result->barcode = $barcode;
        return $result;
    }

    public function getBarcode(): string
    {
        return $this->barcode;
    }

    public function withDiscountPercent(?float $discountPercent): self
    {
        $result = clone $this;
        $result->discountPercent = $discountPercent;
        return $result;
    }

    public function getDiscountPercent(): ?float
    {
        return $this->discountPercent;
    }

    public function withDiscountType($discountType): self
    {
        $result = clone $this;
        $result->discountType = $discountType;
        return $result;
    }

    public function getDiscountType(): float
    {
        return $this->discountType;
    }

    public function withDiscountValue(?float $discountValue): self
    {
        $result = clone $this;
        $result->discountValue = $discountValue;
        return $result;
    }

    public function getDiscountValue(): ?float
    {
        return $this->discountValue;
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

    public function withItemWarehouse($itemWarehouse): self
    {
        $result = clone $this;
        $result->itemWarehouse = $itemWarehouse;
        return $result;
    }

    public function getItemWarehouse()
    {
        return $this->itemWarehouse;
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

    public function withSku(string $sku): self
    {
        $result = clone $this;
        $result->sku = $sku;
        return $result;
    }

    public function getSku(): string
    {
        return $this->sku;
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

    public function withNote($note): self
    {
        $result = clone $this;
        $result->note = $note;
        return $result;
    }

    public function getNote(): string
    {
        return $this->note;
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

    public function getQuantityOrdered(): int
    {
        return $this->quantityOrdered;
    }

    public function withWeightUnit(string $weightUnit): self
    {
        $result = clone $this;
        $result->weightUnit = $weightUnit;
        return $result;
    }

    public function getQuantityCancelled(): int
    {
        return $this->quantityCancelled;
    }

    public function withQuantityCancelled(int $quantityCancelled): self
    {
        $result = clone $this;
        $result->quantityCancelled = $quantityCancelled;
        return $result;
    }

    public function getWeightUnit()
    {
        return $this->weightUnit;
    }

    public function withWeight(float $weight): self
    {
        $result = clone $this;
        $result->weight = $weight;
        return $result;
    }

    public function getWeight(): float
    {
        return $this->weight;
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

    public function withProductImage(ProductImage $productImage): self
    {
        $result = clone $this;
        $result->productImage = $productImage;
        return $result;
    }

    public function getProductImage(): ProductImage
    {
        return $this->productImage;
    }

    public function withMetaData($metaData): self
    {
        $result = clone $this;
        $result->metaData = $metaData;
        return $result;
    }

    public function getMetaData()
    {
        return $this->metaData;
    }

    public function withQuantityShipped(int $quantityShipped): self
    {
        $result = clone $this;
        $result->quantityShipped = $quantityShipped;
        return $result;
    }

    public function getQuantityShipped(): int
    {
        return $this->quantityShipped;
    }

    public function withQuantityAvailable(int $quantityAvailable): self
    {
        $result = clone $this;
        $result->quantityAvailable = $quantityAvailable;
        return $result;
    }

    public function getQuantityAvailable(): int
    {
        return $this->quantityAvailable;
    }

    public function withQuantityOnHand(int $quantityOnHand): self
    {
        $result = clone $this;
        $result->quantityOnHand = $quantityOnHand;
        return $result;
    }

    public function getQuantityOnHand(): int
    {
        return $this->quantityOnHand;
    }

    public function withQuantityReturned(int $quantityReturned): self
    {
        $result = clone $this;
        $result->quantityReturned = $quantityReturned;
        return $result;
    }

    public function getQuantityReturned(): int
    {
        return $this->quantityReturned;
    }

    public function withQuantityDelivered(int $quantityDelivered): self
    {
        $result = clone $this;
        $result->quantityDelivered = $quantityDelivered;
        return $result;
    }

    public function getQuantityDelivered(): int
    {
        return $this->quantityDelivered;
    }

    public function withQuantityPacked(int $quantityPacked): self
    {
        $result = clone $this;
        $result->quantityPacked = $quantityPacked;
        return $result;
    }

    public function getQuantityPacked(): int
    {
        return $this->quantityPacked;
    }

    public function withQuantityDropShipped(int $quantityDropShipped): self
    {
        $result = clone $this;
        $result->quantityDropShipped = $quantityDropShipped;
        return $result;
    }

    public function getQuantityDropShipped(): int
    {
        return $this->quantityDropShipped;
    }

    public function withLastPurchasePrice(?float $lastPurchasePrice): self
    {
        $result = clone $this;
        $result->lastPurchasePrice = $lastPurchasePrice;
        return $result;
    }

    public function getLastPurchasePrice(): ?float
    {
        return $this->lastPurchasePrice;
    }

    public function withBrand(?string $brand): self
    {
        $result = clone $this;
        $result->brand = $brand;
        return $result;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function withCategory(?string $category): self
    {
        $result = clone $this;
        $result->category = $category;
        return $result;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function withDefaultSupplierId(?int $defaultSupplierId): self
    {
        $result = clone $this;
        $result->defaultSupplierId = $defaultSupplierId;
        return $result;
    }

    public function getDefaultSupplierId(): ?int
    {
        return $this->defaultSupplierId;
    }

    public function withType(?string $type): self
    {
        $result = clone $this;
        $result->type = $type;
        return $result;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function withSuppliers(array $suppliers): self
    {
        $result = clone $this;
        $result->suppliers = $suppliers;
        return $result;
    }

    public function getSuppliers(): array
    {
        return $this->suppliers;
    }
}
