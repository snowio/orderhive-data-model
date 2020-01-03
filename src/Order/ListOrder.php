<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class ListOrder
{
    public static function of($id): self
    {
        $order = new self($id);
        $order->listOrderItems = ListOrderItemSet::create();
        $order->tags = OrderTagsListingSet::create();
        return $order;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['id']);
        $result->listOrderItems = ListOrderItemSet::fromJson($json['list_order_items'] ?? []);
        $result->channelOrderId = $json['channel_order_id'] ?? null;
        $result->contactId = $json['contact_id'] ?? null;
        $result->isBackOrder = $json['is_back_order'] ?? null;
        $result->shippingService = $json['shipping_service'] ?? null;
        $result->shippingCarrier = $json['shipping_carrier'] ?? null;
        $result->displayNumber = $json['display_number'] ?? null;
        $result->invoiceCreated = $json['invoice_created'] ?? null;
        $result->currency = $json['currency'] ?? null;
        $result->paymentMethod = $json['payment_method'] ?? null;
        $result->orderStatus = $json['order_status'] ?? null;
        $result->customStatus = $json['custom_status'] ?? null;
        $result->paymentStatus = $json['payment_status'] ?? null;
        $result->billingName = $json['billing_name'] ?? null;
        $result->shippingName = $json['shipping_name'] ?? null;
        $result->channelOrderNumber = $json['channel_order_number'] ?? null;
        $result->referenceNumber = $json['reference_number'] ?? null;
        $result->channelId = $json['channel_id'] ?? null;
        $result->storeId = $json['store_id'] ?? null;
        $result->storeName = $json['store_name'] ?? null;
        $result->channelIcon = $json['channel_icon'] ?? null;
        $result->channelName = $json['channel_name'] ?? null;
        $result->total = $json['total'] ?? 0;
        $result->commentCount = $json['comment_count'] ?? 0;
        $result->syncCreated = $json['sync_created'] ?? null;
        $result->isAnyUnread = $json['is_any_unread'] ?? null;
        $result->partiallyCancel = $json['partially_cancel'] ?? null;
        $result->orderItemsSize = $json['order_items_size'] ?? 0;
        $result->totalQtyOrdered = $json['total_qty_ordered'] ?? 0;
        $result->actionRequired = $json['action_required'] ?? null;
        $result->warehouseId = $json['warehouse_id'] ?? null;
        $result->remark = $json['remark'] ?? null;
        $result->fulfillmentStatus = $json['fulfillment_status'] ?? null;
        $result->customFieldsListing = $json['custom_fields_listing'] ?? null;
        $result->presetId = $json['preset_id'] ?? 0;
        $result->templates = $json['templates'] ?? null;
        $result->printStatus = $json['print_status'] ?? null;
        $result->subUsers = $json['sub_users'] ?? null;
        $result->tags = $json['tags'] ?? null;
        $result->createdDate = $json['created_date'] ?? null;
        $result->deliveryDate = $json['delivery_date'] ?? null;
        $result->shippingDueDate = $json['shipping_due_date'] ?? null;
        $result->modifiedDate = $json['modified_date'] ?? null;

        return $result;
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'channel_order_id' => $this->channelOrderId,
            'contact_id' => $this->contactId,
            'is_back_order' => $this->isBackOrder,
            'shipping_service' => $this->shippingService,
            'shipping_carrier' => $this->shippingCarrier,
            'display_number' => $this->displayNumber,
            'invoice_created' => $this->invoiceCreated,
            'currency' => $this->currency,
            'payment_method' => $this->paymentMethod,
            'order_status' => $this->orderStatus,
            'custom_status' => $this->customStatus,
            'payment_status' => $this->paymentStatus,
            'billing_name' => $this->billingName,
            'shipping_name' => $this->shippingName,
            'channel_order_number' => $this->channelOrderNumber,
            'reference_number' => $this->referenceNumber,
            'channel_id' => $this->channelId,
            'store_id' => $this->storeId,
            'store_name' => $this->storeName,
            'channel_icon' => $this->channelIcon,
            'channel_name' => $this->channelName,
            'total' => $this->total,
            'comment_count' => $this->commentCount,
            'sync_created' => $this->syncCreated,
            'is_any_unread' => $this->isAnyUnread,
            'partially_cancel' => $this->partiallyCancel,
            'list_order_items' => $this->listOrderItems->toJson(),
            'order_items_size' => $this->orderItemsSize,
            'total_qty_ordered' => $this->totalQtyOrdered,
            'action_required' => $this->actionRequired,
            'warehouse_id' => $this->warehouseId,
            'remark' => $this->remark,
            'fulfillment_status' => $this->fulfillmentStatus,
            'custom_fields_listing' => $this->customFieldsListing,
            'preset_id' => $this->presetId,
            'templates' => $this->templates,
            'print_status' => $this->printStatus,
            'sub_users' => $this->subUsers,
            'tags' => $this->tags,
            'created_date' => $this->createdDate,
            'delivery_date' => $this->deliveryDate,
            'shipping_due_date' => $this->shippingDueDate,
            'modified_date' => $this->modifiedDate,
        ];
    }

    public function equals(ListOrder $object): bool
    {
        return ($object instanceof Order) &&
        ($this->warehouseId === $object->warehouseId) &&
        ($this->channelOrderId === $object->channelOrderId) &&
        ($this->contactId === $object->contactId) &&
        ($this->isBackOrder === $object->isBackOrder) &&
        ($this->shippingService === $object->shippingService) &&
        ($this->shippingCarrier === $object->shippingCarrier) &&
        ($this->displayNumber === $object->displayNumber) &&
        ($this->invoiceCreated === $object->invoiceCreated) &&
        ($this->currency === $object->currency) &&
        ($this->paymentMethod === $object->paymentMethod) &&
        ($this->orderStatus === $object->orderStatus) &&
        ($this->customStatus === $object->customStatus) &&
        ($this->paymentStatus === $object->paymentStatus) &&
        ($this->billingName === $object->billingName) &&
        ($this->shippingName === $object->shippingName) &&
        ($this->channelOrderNumber === $object->channelOrderNumber) &&
        ($this->referenceNumber === $object->referenceNumber) &&
        ($this->channelId === $object->channelId) &&
        ($this->storeId === $object->storeId) &&
        ($this->storeName === $object->storeName) &&
        ($this->channelIcon === $object->channelIcon) &&
        ($this->channelName === $object->channelName) &&
        ($this->total === $object->total) &&
        ($this->commentCount === $object->commentCount) &&
        ($this->syncCreated === $object->syncCreated) &&
        ($this->isAnyUnread === $object->isAnyUnread) &&
        ($this->partiallyCancel === $object->partiallyCancel) &&
        ($this->orderItemsSize === $object->orderItemsSize) &&
        ($this->totalQtyOrdered === $object->totalQtyOrdered) &&
        ($this->actionRequired === $object->actionRequired) &&
        ($this->warehouseId === $object->warehouseId) &&
        ($this->remark === $object->remark) &&
        ($this->fulfillmentStatus === $object->fulfillmentStatus) &&
        ($this->customFieldsListing === $object->customFieldsListing) &&
        ($this->presetId === $object->presetId) &&
        ($this->templates === $object->templates) &&
        ($this->printStatus === $object->printStatus) &&
        ($this->subUsers === $object->subUsers) &&
        ($this->tags === $object->tags) &&
        ($this->createdDate === $object->createdDate) &&
        ($this->deliveryDate === $object->deliveryDate) &&
        ($this->shippingDueDate === $object->shippingDueDate) &&
        ($this->modifiedDate === $object->modifiedDate) &&
        ($this->listOrderItems->equals($object->listOrderItems));
    }

    private $id;
    /** @var ListOrderItemSet */
    private $listOrderItems;
    private $channelOrderId;
    private $contactId;
    private $isBackOrder;
    private $shippingService;
    private $shippingCarrier;
    private $displayNumber;
    private $invoiceCreated;
    private $currency;
    private $paymentMethod;
    private $orderStatus;
    private $customStatus;
    private $paymentStatus;
    private $billingName;
    private $shippingName;
    private $channelOrderNumber;
    private $referenceNumber;
    private $channelId;
    private $storeId;
    private $storeName;
    private $channelIcon;
    private $channelName;
    private $total;
    private $commentCount;
    private $syncCreated;
    private $isAnyUnread;
    private $partiallyCancel;
    private $orderItemsSize;
    private $totalQtyOrdered;
    private $actionRequired;
    private $warehouseId;
    private $remark;
    private $fulfillmentStatus;
    private $customFieldsListing;
    private $presetId;
    private $templates;
    private $printStatus;
    private $subUsers;
    private $tags;
    private $createdDate;
    private $deliveryDate;
    private $shippingDueDate;
    private $modifiedDate;

    private function __construct($id)
    {
        $this->id = $id;
        $this->listOrderItems = ListOrderItemSet::create();
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

    public function withDeliveryDate(?string $deliveryDate): self
    {
        $result = clone $this;
        $result->deliveryDate = $deliveryDate;
        return $result;
    }

    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    public function withContactId(int $contactId)
    {
        $result = clone $this;
        $result->contactId = $contactId;
        return $result;
    }

    public function getContactId()
    {
        return $this->contactId;
    }

    public function withChannelId(int $channelId): self
    {
        $result = clone $this;
        $result->channelId = $channelId;
        return $result;
    }

    public function getChannelId(): ?int
    {
        return $this->channelId;
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

    public function withChannelOrderId(?int $channelOrderId): self
    {
        $result = clone $this;
        $result->channelOrderId = $channelOrderId;
        return $result;
    }

    public function getChannelOrderId(): ?int
    {
        return $this->channelOrderId;
    }

    public function withIsBackOrder(?bool $isBackOrder): self
    {
        $result = clone $this;
        $result->isBackOrder = $isBackOrder;
        return $result;
    }

    public function getIsBackOrder(): ?bool
    {
        return $this->isBackOrder;
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

    public function withInvoiceCreated(?bool $invoiceCreated): self
    {
        $result = clone $this;
        $result->invoiceCreated = $invoiceCreated;
        return $result;
    }

    public function getInvoiceCreated(): ?bool
    {
        return $this->invoiceCreated;
    }

    public function withCustomStatus(?int $customStatus): self
    {
        $result = clone $this;
        $result->customStatus = $customStatus;
        return $result;
    }

    public function getCustomStatus(): ?int
    {
        return $this->customStatus;
    }

    public function withBillingName(?string $billingName): self
    {
        $result = clone $this;
        $result->billingName = $billingName;
        return $result;
    }

    public function getBillingName(): ?string
    {
        return $this->billingName;
    }

    public function withShippingName(?string $shippingName): self
    {
        $result = clone $this;
        $result->shippingName = $shippingName;
        return $result;
    }

    public function getShippingName(): ?string
    {
        return $this->shippingName;
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

    public function withStoreName(?string $storeName): self
    {
        $result = clone $this;
        $result->storeName = $storeName;
        return $result;
    }

    public function getStoreName(): ?string
    {
        return $this->storeName;
    }

    public function withChannelIcon(?string $channelIcon): self
    {
        $result = clone $this;
        $result->channelIcon = $channelIcon;
        return $result;
    }

    public function getChannelIcon(): ?string
    {
        return $this->channelIcon;
    }

    public function withChannelName(?string $channelName): self
    {
        $result = clone $this;
        $result->channelName = $channelName;
        return $result;
    }

    public function getChannelName(): ?string
    {
        return $this->channelName;
    }

    public function withTotal(float $total): self
    {
        $result = clone $this;
        $result->total = $total;
        return $result;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function withCommentCount(int $commentCount): self
    {
        $result = clone $this;
        $result->commentCount = $commentCount;
        return $result;
    }

    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    public function withIsAnyUnread(?bool $isAnyUnread): self
    {
        $result = clone $this;
        $result->isAnyUnread = $isAnyUnread;
        return $result;
    }

    public function getIsAnyUnread(): ?bool
    {
        return $this->isAnyUnread;
    }

    public function withPartiallyCancel(?bool $partiallyCancel): self
    {
        $result = clone $this;
        $result->partiallyCancel = $partiallyCancel;
        return $result;
    }

    public function getPartiallyCancel(): ?bool
    {
        return $this->partiallyCancel;
    }

    public function withListOrderItems(ListOrderItemSet $listOrderItems): self
    {
        $result = clone $this;
        $result->listOrderItems = $listOrderItems;
        return $result;
    }

    public function getListOrderItems(): ListOrderItemSet
    {
        return $this->listOrderItems;
    }

    public function withModifiedDate($modifiedDate): self
    {
        $result = clone $this;
        $result->modifiedDate = $modifiedDate;
        return $result;
    }

    public function getModifiedDate(): ?string
    {
        return $this->modifiedDate;
    }

    public function withShippingDueDate(?string $shippingDueDate): self
    {
        $result = clone $this;
        $result->shippingDueDate = $shippingDueDate;
        return $result;
    }

    public function getShippingDueDate(): ?string
    {
        return $this->shippingDueDate;
    }

    public function withCreatedDate(?string $createdDate): self
    {
        $result = clone $this;
        $result->createdDate = $createdDate;
        return $result;
    }

    public function getCreatedDate(): ?string
    {
        return $this->createdDate;
    }

    public function withSyncCreated(?string $syncCreated): self
    {
        $result = clone $this;
        $result->syncCreated = $syncCreated;
        return $result;
    }

    public function getSyncCreated(): ?string
    {
        return $this->syncCreated;
    }

    public function withOrderItemsSize(int $orderItemsSize): self
    {
        $result = clone $this;
        $result->orderItemsSize = $orderItemsSize;
        return $result;
    }

    public function getOrderItemsSize(): int
    {
        return $this->orderItemsSize;
    }

    public function withTotalQtyOrdered(int $totalQtyOrdered): self
    {
        $result = clone $this;
        $result->totalQtyOrdered = $totalQtyOrdered;
        return $result;
    }

    public function getTotalQtyOrdered():int
    {
        return $this->totalQtyOrdered;
    }

    public function withActionRequired(?bool $actionRequired): self
    {
        $result = clone $this;
        $result->actionRequired = $actionRequired;
        return $result;
    }

    public function getActionRequired(): ?bool
    {
        return $this->actionRequired;
    }

    public function withFulfillmentStatus(?string $fulfillmentStatus): self
    {
        $result = clone $this;
        $result->fulfillmentStatus = $fulfillmentStatus;
        return $result;
    }

    public function getFulfillmentStatus(): ?string
    {
        return $this->fulfillmentStatus;
    }

    public function withCustomFieldsListing(?array $customFieldsListing): self
    {
        $result = clone $this;
        $result->customFieldsListing = $customFieldsListing;
        return $result;
    }

    public function getCustomFieldsListing(): ?array
    {
        return $this->customFieldsListing;
    }

    public function withPresetId(int $presetId): self
    {
        $result = clone $this;
        $result->presetId = $presetId;
        return $result;
    }

    public function getPresetId(): int
    {
        return $this->presetId;
    }

    public function withTemplates(?string $templates): self
    {
        $result = clone $this;
        $result->templates = $templates;
        return $result;
    }

    public function getTemplates(): ?string
    {
        return $this->templates;
    }

    public function withPrintStatus(?string $printStatus): self
    {
        $result = clone $this;
        $result->printStatus = $printStatus;
        return $result;
    }

    public function getPrintStatus(): ?string
    {
        return $this->printStatus;
    }

    public function withSubUsers(string $subUsers): self
    {
        $result = clone $this;
        $result->subUsers = $subUsers;
        return $result;
    }

    public function getSubUsers(): ?string
    {
        return $this->subUsers;
    }

    public function withTags(OrderTagsListingSet $tags): self
    {
        $result = clone $this;
        $result->tags = $tags;
        return $result;
    }

    public function getTags(): OrderTagsListingSet
    {
        return $this->tags;
    }
}
