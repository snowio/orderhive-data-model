<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class CreateOrder
{
    public static function of($referenceNumber): self
    {
        $order = new self($referenceNumber);
        $order->orderItems = ItemSet::create();
        $order->orderExtraItems = ExtraItemSet::create();
        $order->shippingAddress = Address::create();
        $order->billingAddress = Address::create();
        return $order;
    }

    /**
     * @param array $json
     * @return CreateOrder
     */
    public static function fromJson(array $json): self
    {
        $result = self::of($json['reference_number']);
        $result->storeId = $json['store_id'] ?? null;
        $result->paymentMethod = $json['payment_method'] ?? null;
        $result->paymentStatus = $json['payment_status'] ?? null;
        $result->deliveryDate = $json['delivery_date'] ?? null;
        $result->warehouseId = $json['warehouse_id'] ?? null;
        $result->taxType = $json['tax_type'] ?? null;
        $result->currency = $json['currency'] ?? null;
        $result->orderStatus = $json['order_status'] ?? null;
        $result->channelOrderNumber = $json['channel_order_number'] ?? null;
        $result->grandTotal = $json['grand_total'] ?? null;
        $result->syncCreated = $json['sync_created'] ?? null;
        $result->remark = $json['remark'] ?? null;
        $result->contactId = $json['contact_id'] ?? null;
        $result->baseCurrencyRate = $json['base_currency_rate'] ?? null;
        $result->baseCurrency = $json['base_currency'] ?? null;
        $result->shippingAddress = Address::fromJson($json['shipping_address'] ?? []);
        $result->billingAddress = Address::fromJson($json['billing_address'] ?? []);
        $result->orderItems = ItemSet::fromJson($json['order_items'] ?? []);
        $result->orderExtraItems = ExtraItemSet::fromJson($json['extra_order_items'] ?? []);
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
            'contact_id' => $this->contactId,
            'base_currency_rate' => $this->baseCurrencyRate,
            'base_currency' => $this->baseCurrency,
            'remark' => $this->remark,
            'reference_number' => $this->referenceNumber,
            'currency' => $this->currency,
            'channel_order_number' => $this->channelOrderNumber,
            'order_status' => $this->orderStatus,
            'store_id' => $this->storeId,
            'tax_type' => $this->taxType,
            'order_items' => $this->orderItems->toJson(),
            'order_extra_items' => $this->orderExtraItems->toJson(),
            'shipping_address' => $this->shippingAddress->toJson(),
            'billing_address' => $this->billingAddress->toJson()
        ];
    }

    public function equals(CreateOrder $object): bool
    {
        return ($object instanceof CreateOrder) &&
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
        ($this->channelOrderId === $object->channelOrderId) &&
        ($this->contactId === $object->contactId) &&
        ($this->channelOrderNumber === $object->channelOrderNumber) &&
        ($this->baseCurrencyRate === $object->baseCurrencyRate) &&
        ($this->baseCurrency === $object->baseCurrency) &&
        ($this->customFields === $object->customFields) &&
        ($this->displayNumber === $object->displayNumber) &&
        ($this->salesPersonId === $object->salesPersonId) &&
        ($this->shippingCarrier === $object->shippingCarrier) &&
        ($this->shippingService === $object->shippingService) &&
        ($this->shippingAddress->equals($object->shippingAddress)) &&
        ($this->billingAddress->equals($object->billingAddress)) &&
        ($this->orderExtraItems->equals($object->orderExtraItems)) &&
        ($this->orderItems->equals($object->orderItems));
    }

    private $baseCurrency;
    private $baseCurrencyRate;
    /** @var Address */
    private $billingAddress;
    private $channelOrderId;
    private $contactId;
    private $currency;
    private $customFields;
    private $deliveryDate;
    private $displayNumber;
    private $grandTotal;
    private $channelOrderNumber;
    /** @var ItemSet */
    private $orderItems;
    /** @var ExtraItemSet */
    private $orderExtraItems;
    private $orderStatus;
    private $paymentMethod;
    private $paymentStatus;
    private $referenceNumber;
    private $remark;
    private $salesPersonId;
    /** @var Address */
    private $shippingAddress;
    private $shippingCarrier;
    private $shippingService;
    private $storeId;
    private $syncCreated;
    private $taxType;
    private $warehouseId;

    private function __construct($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
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

    public function getChannelOrderNumber(): ?string
    {
        return $this->channelOrderNumber;
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

    public function withReferenceNumber(?string $referenceNumber): self
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

    public function getOrderExtraItems(): ?ExtraItemSet
    {
        return $this->orderExtraItems;
    }

    public function withOrderExtraItems(ExtraItemSet $orderExtraItems): self
    {
        $result = clone $this;
        $result->orderExtraItems = $orderExtraItems;
        return $result;
    }

    public function withPaymentStatus(?string $paymentStatus)
    {
        $result = clone $this;
        $result->paymentStatus = $paymentStatus;
        return $result;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function withPaymentMethod(?string $paymentMethod)
    {
        $result = clone $this;
        $result->paymentMethod = $paymentMethod;
        return $result;
    }

    public function getPaymentMethod() :?string
    {
        return $this->paymentMethod;
    }

    public function withDeliveryDate($deliveryDate)
    {
        $result = clone $this;
        $result->deliveryDate = $deliveryDate;
        return $result;
    }

    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    public function withBaseCurrency($baseCurrency)
    {
        $result = clone $this;
        $result->baseCurrency = $baseCurrency;
        return $result;
    }

    public function getBaseCurrency()
    {
        return $this->baseCurrency;
    }

    public function withBaseCurrencyRate(?float $baseCurrencyRate)
    {
        $result = clone $this;
        $result->baseCurrencyRate = $baseCurrencyRate;
        return $result;
    }

    public function getBaseCurrencyRate(): ?float
    {
        return $this->baseCurrencyRate;
    }

    public function withContactId(?int $contactId): self
    {
        $result = clone $this;
        $result->contactId = $contactId;
        return $result;
    }

    public function getContactId(): ?int
    {
        return $this->contactId;
    }

    public function withRemark($remark): self
    {
        $result = clone $this;
        $result->remark = $remark;
        return $result;
    }

    public function getRemark()
    {
        return $this->remark;
    }

    public function withSyncCreated($syncCreated): self
    {
        $result = clone $this;
        $result->syncCreated = $syncCreated;
        return $result;
    }

    public function getSyncCreated()
    {
        return $this->syncCreated;
    }

    public function withGrandTotal(?float $grandTotal): self
    {
        $result = clone $this;
        $result->grandTotal = $grandTotal;
        return $result;
    }

    public function getGrandTotal(): ?float
    {
        return $this->grandTotal;
    }

    public function withShippingAddress(Address $shippingAddress): self
    {
        $result = clone $this;
        $result->shippingAddress = $shippingAddress;
        return $result;
    }

    public function getShippingAddress(): Address
    {
        return $this->shippingAddress;
    }

    public function withBillingAddress(Address $billingAddress): self
    {
        $result = clone $this;
        $result->billingAddress = $billingAddress;
        return $result;
    }

    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    public function withWarehouseId(int $warehouseId): self
    {
        $result = clone $this;
        $result->warehouseId = $warehouseId;
        return $result;
    }

    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }

    public function withShippingService(?string $shippingService): self
    {
        $result = clone $this;
        $result->shippingService = $shippingService;
        return $result;
    }

    public function getShippingService(): ?string
    {
        return $this->shippingService;
    }

    public function withShippingCarrier(?string $shippingCarrier): self
    {
        $result = clone $this;
        $result->shippingCarrier = $shippingCarrier;
        return $result;
    }

    public function getShippingCarrier(): ?string
    {
        return $this->shippingCarrier;
    }

    public function withDisplayNumber(?string $displayNumber): self
    {
        $result = clone $this;
        $result->displayNumber = $displayNumber;
        return $result;
    }

    public function getDisplayNumber(): ?string
    {
        return $this->displayNumber;
    }

    public function withCustomFields($customFields): self
    {
        $result = clone $this;
        $result->customFields = $customFields;
        return $result;
    }

    public function withChannelOrderNumber(string $channelOrderNumber): self
    {
        $result = clone $this;
        $result->channelOrderNumber = $channelOrderNumber;
        return $result;
    }

    public function getCustomFields(): ?array
    {
        return $this->customFields;
    }

    public function withSalesPersonId(?int $salesPersonId): self
    {
        $result = clone $this;
        $result->salesPersonId = $salesPersonId;
        return $result;
    }

    public function getSalesPersonId(): ?int
    {
        return $this->salesPersonId;
    }
}
