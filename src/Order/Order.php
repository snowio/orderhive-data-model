<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class Order
{
    public static function of($id): self
    {
        $order = new self($id);
        $order->orderItems = ItemSet::create();
        $order->shippingAddress = Address::create();
        $order->billingAddress = Address::create();
        $order->taxInfo = TaxInfo::create();
        return $order;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['id']);
        $result->storeId = $json['store_id'] ?? null;
        $result->referenceNumber = $json['reference_number'] ?? null;
        $result->paymentMethod = $json['payment_method'] ?? null;
        $result->paymentStatus = $json['payment_status'] ?? null;
        $result->deliveryDate = $json['delivery_date'] ?? null;
        $result->warehouseId = $json['warehouse_id'] ?? null;
        $result->taxType = $json['tax_type'] ?? null;
        $result->currency = $json['currency'] ?? null;
        $result->orderStatus = $json['order_status'] ?? null;
        $result->grandTotal = $json['grand_total'] ?? null;
        $result->syncCreated = $json['sync_created'] ?? null;
        $result->remark = $json['remark'] ?? null;
        $result->channelId = $json['channel_id'] ?? null;
        $result->contactId = $json['contact_id'] ?? null;
        $result->baseCurrencyRate = $json['base_currency_rate'] ?? null;
        $result->baseCurrency = $json['base_currency'] ?? null;
        $result->channelPrimaryId = $json['channel_primary_id'] ?? null;
        $result->channelSecondaryId = $json['channel_secondary_id'] ?? null;
        $result->components = $json['components'] ?? null;
        $result->itemWarehouse = $json['item_warehouse'] ?? null;
        $result->metaData = $json['meta_data'] ?? null;
        $result->quantityInvoiced = $json['quantity_invoiced'] ?? null;
        $result->taxValue = $json['tax_value'] ?? null;
        $result->updateType = $json['update_type'] ?? null;
        $result->weight = $json['weight'] ?? null;
        $result->weightUnit = $json['weight_unit'] ?? null;
        $result->taxInfo = TaxInfo::fromJson($json['tax_info'] ?? []);
        $result->shippingAddress = Address::fromJson($json['shipping_address'] ?? []);
        $result->billingAddress = Address::fromJson($json['billing_address'] ?? []);
        $result->orderItems = ItemSet::fromJson($json['order_items'] ?? []);
        return $result;
    }

    public function toJson(): array
    {
        return [
            'warehouse_id' => $this->warehouseId,
            'payment_status' => $this->paymentStatus,
            'payment_method' => $this->paymentMethod,
            'delivery_date' => $this->deliveryDate,
            'grand_total' => $this->grandTotal,
            'sync_created' => $this->syncCreated,
            'channel_id' => $this->channelId,
            'contact_id' => $this->contactId,
            'base_currency_rate' => $this->baseCurrencyRate,
            'base_currency' => $this->baseCurrency,
            'remark' => $this->remark,
            'reference_number' => $this->referenceNumber,
            'currency' => $this->currency,
            'order_status' => $this->orderStatus,
            'store_id' => $this->storeId,
            'tax_type' => $this->taxType,
            'channel_primary_id' => $this->channelPrimaryId,
            'channel_secondary_id' => $this->channelSecondaryId,
            'components' => $this->components,
            'id' => $this->id,
            'item_warehouse' => $this->itemWarehouse,
            'meta_data' => $this->metaData,
            'quantity_invoiced' => $this->quantityInvoiced,
            'tax_value' => $this->taxValue,
            'update_type' => $this->updateType,
            'weight' => $this->weight,
            'weight_unit' => $this->weightUnit,
            'tax_info' => $this->taxInfo->toJson(),
            'order_items' => $this->orderItems->toJson(),
            'shipping_address' => $this->shippingAddress->toJson(),
            'billing_address' => $this->billingAddress->toJson(),
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Order) &&
        ($this->warehouseId === $object->warehouseId) &&
        ($this->paymentMethod === $object->paymentMethod) &&
        ($this->paymentStatus === $object->paymentStatus) &&
        ($this->referenceNumber === $object->referenceNumber) &&
        ($this->currency === $object->currency) &&
        ($this->orderStatus === $object->orderStatus) &&
        ($this->storeId === $object->storeId) &&
        ($this->deliveryDate === $object->deliveryDate) &&
        ($this->taxType === $object->taxType) &&
        ($this->grandTotal === $object->grandTotal) &&
        ($this->syncCreated === $object->syncCreated) &&
        ($this->remark === $object->remark) &&
        ($this->channelId === $object->channelId) &&
        ($this->contactId === $object->contactId) &&
        ($this->baseCurrencyRate === $object->baseCurrencyRate) &&
        ($this->baseCurrency === $object->baseCurrency) &&
        ($this->channelPrimaryId === $object->channelPrimaryId) &&
        ($this->channelSecondaryId === $object->channelSecondaryId) &&
        ($this->components === $object->components) &&
        ($this->id === $object->id) &&
        ($this->itemWarehouse === $object->itemWarehouse) &&
        ($this->metaData === $object->metaData) &&
        ($this->quantityInvoiced === $object->quantityInvoiced) &&
        ($this->taxValue === $object->taxValue) &&
        ($this->updateType === $object->updateType) &&
        ($this->weight === $object->weight) &&
        ($this->weightUnit === $object->weightUnit) &&
        ($this->taxInfo->equals($object->taxInfo)) &&
        ($this->orderItems->equals($object->orderItems));
    }

    private $storeId;
    private $warehouseId;
    private $referenceNumber;
    private $taxType;
    private $currency;
    private $orderStatus;
    private $paymentStatus;
    private $paymentMethod;
    private $deliveryDate;
    private $grandTotal;
    private $syncCreated;
    private $remark;
    private $channelId;
    private $contactId;
    private $baseCurrencyRate;
    private $baseCurrency;
    private $channelPrimaryId;
    private $channelSecondaryId;
    private $components;
    private $id;
    private $itemWarehouse;
    private $metaData;
    private $quantityInvoiced;
    private $taxInfo;
    private $taxValue;
    private $updateType;
    private $weight;
    private $weightUnit;
    private $shippingAddress;
    private $billingAddress;

    /** @var ItemSet */
    private $orderItems;

    private function __construct($id)
    {
        $this->id = $id;
        $this->taxInfo = TaxInfo::create();
    }

    public function getOrderType(): ?string
    {
        return $this->storeId;
    }

    public function withOrderType(string $storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    public function getOrderStatus(): ?string
    {
        return $this->orderStatus;
    }

    public function withOrderStatus(string $orderStatus): self
    {
        $result = clone $this;
        $result->orderStatus = $orderStatus;
        return $result;
    }

    public function getTaxType(): ?string
    {
        return $this->taxType;
    }

    public function withTaxType(string $taxType): self
    {
        $result = clone $this;
        $result->taxType = $taxType;
        return $result;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function withReferenceNumber(string $referenceNumber): self
    {
        $result = clone $this;
        $result->referenceNumber = $referenceNumber;
        return $result;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function withCurrency(string $currency): self
    {
        $result = clone $this;
        $result->currency = $currency;
        return $result;
    }

    public function getStoreId(): int
    {
        return $this->storeId;
    }

    public function withStoreId(int $storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    public function getOrderItems(): ?ItemSet
    {
        return $this->orderItems;
    }

    public function withOrderItems(ItemSet $orderItems): self
    {
        $result = clone $this;
        $result->orderItems = $orderItems;
        return $result;
    }

    /**
     * @param string|null $paymentStatus
     * @return Order
     */
    public function withPaymentStatus(?string $paymentStatus)
    {
        $result = clone $this;
        $result->paymentStatus = $paymentStatus;
        return $result;
    }

    /**
     * @return string
     */
    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    /**
     * @param string $paymentMethod
     * @return Order
     */
    public function withPaymentMethod(?string $paymentMethod)
    {
        $result = clone $this;
        $result->paymentMethod = $paymentMethod;
        return $result;
    }

    /**
     * @return string
     */
    public function getPaymentMethod() :?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param mixed $deliveryDate
     * @return Order
     */
    public function withDeliveryDate($deliveryDate)
    {
        $result = clone $this;
        $result->deliveryDate = $deliveryDate;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param mixed $baseCurrency
     * @return Order
     */
    public function withBaseCurrency($baseCurrency)
    {
        $result = clone $this;
        $result->baseCurrency = $baseCurrency;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * @param mixed $baseCurrencyRate
     * @return Order
     */
    public function withBaseCurrencyRate($baseCurrencyRate)
    {
        $result = clone $this;
        $result->baseCurrencyRate = $baseCurrencyRate;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getBaseCurrencyRate()
    {
        return $this->baseCurrencyRate;
    }

    /**
     * @param mixed $contactId
     * @return Order
     */
    public function withContactId($contactId)
    {
        $result = clone $this;
        $result->contactId = $contactId;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @param int $channelId
     * @return Order
     */
    public function withChannelId(int $channelId): self
    {
        $result = clone $this;
        $result->channelId = $channelId;
        return $result;
    }

    /**
     * @return int|null
     */
    public function getChannelId(): ?int
    {
        return $this->channelId;
    }

    /**
     * @param mixed $remark
     * @return Order
     */
    public function withRemark($remark): self
    {
        $result = clone $this;
        $result->remark = $remark;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param mixed $syncCreated
     * @return Order
     */
    public function withSyncCreated($syncCreated): self
    {
        $result = clone $this;
        $result->syncCreated = $syncCreated;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getSyncCreated()
    {
        return $this->syncCreated;
    }

    /**
     * @param mixed $grandTotal
     * @return Order
     */
    public function withGrandTotal($grandTotal): self
    {
        $result = clone $this;
        $result->grandTotal = $grandTotal;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getGrandTotal()
    {
        return $this->grandTotal;
    }

    /**
     * @param mixed $channelPrimaryId
     * @return Order
     */
    public function withChannelPrimaryId($channelPrimaryId): self
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
     * @param mixed $channelSecondaryId
     * @return Order
     */
    public function withChannelSecondaryId($channelSecondaryId): self
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
     * @return Order
     */
    public function withComponents($components): self
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
     * @param int|null $id
     * @return Order
     */
    public function withId(?int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $itemWarehouse
     * @return Order
     */
    public function withItemWarehouse($itemWarehouse): self
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
     * @param mixed $metaData
     * @return Order
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

    /**
     * @param int|null $quantityInvoiced
     * @return Order
     */
    public function withQuantityInvoiced(?int $quantityInvoiced): self
    {
        $result = clone $this;
        $result->quantityInvoiced = $quantityInvoiced;
        return $result;
    }

    /**
     * @return int|null
     */
    public function getQuantityInvoiced(): ?int
    {
        return $this->quantityInvoiced;
    }

    /**
     * @param TaxInfo $taxInfo
     * @return Order
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
     * @param float|null $taxValue
     * @return Order
     */
    public function withTaxValue(?float $taxValue): self
    {
        $result = clone $this;
        $result->taxValue = $taxValue;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getTaxValue(): ?float
    {
        return $this->taxValue;
    }

    /**
     * @param string|null $updateType
     * @return Order
     */
    public function withUpdateType(?string $updateType): self
    {
        $result = clone $this;
        $result->updateType = $updateType;
        return $result;
    }

    /**
     * @return string|null
     */
    public function getUpdateType(): ?string
    {
        return $this->updateType;
    }

    /**
     * @param float|null $weight
     * @return Order
     */
    public function withWeight(?float $weight): self
    {
        $result = clone $this;
        $result->weight = $weight;
        return $result;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param mixed $weightUnit
     * @return Order
     */
    public function withWeightUnit(?string $weightUnit): self
    {
        $result = clone $this;
        $result->weightUnit = $weightUnit;
        return $result;
    }

    /**
     * @return string|null
     */
    public function getWeightUnit(): ?string
    {
        return $this->weightUnit;
    }

    /**
     * @param Address $shippingAddress
     * @return Order
     */
    public function withShippingAddress(Address $shippingAddress): self
    {
        $result = clone $this;
        $result->shippingAddress = $shippingAddress;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getShippingAddress(): Address
    {
        return $this->shippingAddress;
    }

    /**
     * @param Address $billingAddress
     * @return Order
     */
    public function withBillingAddress(Address $billingAddress): self
    {
        $result = clone $this;
        $result->billingAddress = $billingAddress;
        return $result;
    }

    /**
     * @return Address
     */
    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    /**
     * @param int $warehouseId
     * @return Order
     */
    public function withWarehouseId(int $warehouseId): self
    {
        $result = clone $this;
        $result->warehouseId = $warehouseId;
        return $result;
    }

    /**
     * @return int
     */
    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }
}
