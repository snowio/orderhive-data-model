<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class EditOrder
{
    public static function of($id): self
    {
        $order = new self($id);
        $order->orderItems = ItemSet::create();
        $order->shippingAddress = Address::create();
        $order->billingAddress = Address::create();
        return $order;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['id']);
        $result->contactId = $json['contact_id'] ?? null;
        $result->channelOrderNumber = $json['channel_order_number'] ?? null;
        $result->paymentMethod = $json['payment_method'] ?? null;
        $result->referenceNumber = $json['reference_number'] ?? null;
        $result->salesPersonId = $json['sales_person_id'] ?? null;
        $result->remark = $json['remark'] ?? null;
        $result->deliveryDate = $json['delivery_date'] ?? null;
        $result->shippingCarrier = $json['shipping_carrier'] ?? null;
        $result->shippingService = $json['shipping_service'] ?? null;
        $result->presetId = $json['preset_id'] ?? null;
        $result->shippingAddress = Address::fromJson($json['shipping_address'] ?? []);
        $result->billingAddress = Address::fromJson($json['billing_address'] ?? []);
        $result->orderItems = ItemSet::fromJson($json['order_items'] ?? []);
        return $result;
    }

    public function toJson(): array
    {
        return [
            'contact_id' => $this->contactId,
            'channel_order_number' => $this->channelOrderNumber,
            'payment_method' => $this->paymentMethod,
            'reference_number' => $this->referenceNumber,
            'sales_person_id' => $this->salesPersonId,
            'remark' => $this->remark,
            'delivery_date' => $this->deliveryDate,
            'shipping_carrier' => $this->shippingCarrier,
            'shipping_service' => $this->shippingService,
            'shipping_address' => $this->shippingAddress->toJson(),
            'billing_address' => $this->billingAddress->toJson(),
            'preset_id' => $this->presetId,
            'order_items' => $this->orderItems->toJson(),
        ];
    }

    public function equals(EditOrder $object): bool
    {
        return ($object instanceof EditOrder) &&
        ($this->id === $object->id) &&
        ($this->paymentMethod === $object->paymentMethod) &&
        ($this->referenceNumber === $object->referenceNumber) &&
        ($this->deliveryDate === $object->deliveryDate) &&
        ($this->remark === $object->remark) &&
        ($this->channelOrderNumber === $object->channelOrderNumber) &&
        ($this->contactId === $object->contactId) &&
        ($this->customFields === $object->customFields) &&
        ($this->salesPersonId === $object->salesPersonId) &&
        ($this->shippingCarrier === $object->shippingCarrier) &&
        ($this->shippingService === $object->shippingService) &&
        ($this->presetId === $object->presetId) &&
        ($this->shippingAddress->equals($object->shippingAddress)) &&
        ($this->billingAddress->equals($object->billingAddress)) &&
        ($this->orderItems->equals($object->orderItems));
    }

    private $id;
    private $contactId;
    private $channelOrderNumber;
    private $paymentMethod;
    private $referenceNumber;
    private $salesPersonId;
    private $remark;
    private $deliveryDate;
    private $shippingCarrier;
    private $shippingService;
    private $billingAddress;
    private $shippingAddress;
    private $presetId;
    private $orderItems;
    private $customFields;

    private function __construct($id)
    {
        $this->id = $id;
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

    public function withCustomFields($customFields): self
    {
        $result = clone $this;
        $result->customFields = $customFields;
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

    public function withChannelOrderNumber(?string $channelOrderNumber): self
    {
        $result = clone $this;
        $result->channelOrderNumber = $channelOrderNumber;
        return $result;
    }

    public function getChannelOrderNumber(): ?string
    {
        return $this->channelOrderNumber;
    }

    public function withPresetId(?string $presetId): self
    {
        $result = clone $this;
        $result->presetId = $presetId;
        return $result;
    }

    public function getPresetId(): ?string
    {
        return $this->presetId;
    }
}
