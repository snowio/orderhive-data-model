<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\PurchaseOrder\Create;

use SnowIO\OrderHiveDataModel\PurchaseOrder\CustomFieldsSet;

final class PurchaseOrder
{
    public static function of(): self
    {
        $order = new self();
        $order->customFields = CustomFieldsSet::create();
        $order->purchaseOrderItems = PurchaseOrderItems::create();
        return $order;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of();
        $result->paymentTerm = $json['payment_term'] ?? null;
        $result->currency = $json['currency'] ?? null;
        $result->expectedDate = $json['expected_date'] ?? null;
        $result->poCreatedDate = $json['po_created_date'] ?? null;
        $result->warehouse = $json['warehouse']['id'] ?? [];
        $result->supplier = Supplier::fromJson($json['supplier']) ?? null;
        $result->baseCurrencyRate = $json['base_currency_rate'] ?? null;
        $result->baseCurrency = $json['base_currency'] ?? null;
        $result->total = $json['total'] ?? null;
        $result->updateWarehouseStock = $json['update_warehouse_stock'] ?? null;
        $result->updateIncomingOnDraf = $json['update_incoming_on_draft'] ?? null;
        $result->purchaseOrderItems = PurchaseOrderItems::fromJson($json['purchaseOrderItems']) ?? null;
        $result->purchaseOrderExtraItems = $json['purchaseOrderExtraItems'] ?? null;
        $result->folderDetail = $json['folder_detail'] ?? null;

        $result->customFields = isset($json['custom_fields'])
            ? CustomFieldsSet::fromJson($json['custom_fields'])
            : CustomFieldsSet::create();

        return $result;
    }

    public function toJson(): array
    {
        $json = [
            'currency' => $this->currency,
            'payment_term' => $this->paymentTerm,
            'expected_date' => $this->expectedDate,
            'po_created_date' => $this->poCreatedDate,
            'warehouse' => ($this->warehouse) ?  [
                'id' => $this->warehouse
            ] : [],
            'supplier' => ($this->supplier) ? $this->supplier->toJson() : null,
            'base_currency_rate' => $this->baseCurrencyRate,
            'base_currency' => $this->baseCurrency,
            'total' => $this->total,
            'update_warehouse_stock' => $this->updateWarehouseStock,
            'update_incoming_on_draft' => $this->updateIncomingOnDraf,
            'purchaseOrderItems' => $this->purchaseOrderItems->toJson(),
            'purchaseOrderExtraItems' => $this->purchaseOrderExtraItems,
            'folder_detail' => $this->folderDetail,
        ];

        if ($this->customFields->count()) {
            $json += ['custom_fields' => $this->customFields->toJson()];
        }

        return $json;
    }

    public function equals(PurchaseOrder $object): bool
    {
        return ($object instanceof PurchaseOrder) &&
        ($this->currency === $object->currency) &&
        ($this->paymentTerm === $object->paymentTerm) &&
        ($this->expectedDate === $object->expectedDate) &&
        ($this->poCreatedDate === $object->poCreatedDate) &&
        ($this->warehouse === $object->warehouse) &&
        ($this->supplier->equals($object->supplier)) &&
        ($this->baseCurrencyRate === $object->baseCurrencyRate) &&
        ($this->baseCurrency === $object->baseCurrency) &&
        ($this->total === $object->total) &&
        ($this->folderDetail === $object->folderDetail) &&
        ($this->updateWarehouseStock === $object->updateWarehouseStock) &&
        ($this->updateIncomingOnDraf === $object->updateIncomingOnDraf) &&
        ($this->purchaseOrderItems->equals($object->purchaseOrderItems)) &&
        ($this->purchaseOrderExtraItems->equals($object->purchaseOrderExtraItems)) &&
        ($this->customFields->equals($object->customFields));
    }

    private $currency;
    private $paymentTerm;
    private $expectedDate;
    private $poCreatedDate;
    private $warehouse;
    /** @var Supplier $supplier */
    private $supplier;
    private $baseCurrencyRate;
    private $baseCurrency;
    private $total;
    private $updateWarehouseStock;
    private $updateIncomingOnDraf;
    /** @var PurchaseOrderItems $purchaseOrderItems */
    private $purchaseOrderItems;
    private $purchaseOrderExtraItems = [];
    private $folderDetail;

    /** @var CustomFieldsSet */
    private $customFields;

    private function __construct()
    {
    }

    public function withPaymentTerm(?string $paymentTerm): self
    {
        $result = clone $this;
        $result->paymentTerm = $paymentTerm;
        return $result;
    }

    public function getPaymentTerm() :?string
    {
        return $this->paymentTerm;
    }

    public function withExpectedDate(?string $expectedDate): self
    {
        $result = clone $this;
        $result->expectedDate = $expectedDate;
        return $result;
    }

    public function getExpectedDate(): ?string
    {
        return $this->expectedDate;
    }

    public function withCurrency($currency): self
    {
        $result = clone $this;
        $result->currency = $currency;
        return $result;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function withCustomFields(CustomFieldsSet $customFields): self
    {
        $result = clone $this;
        $result->customFields = $customFields;
        return $result;
    }

    public function getCustomFields(): CustomFieldsSet
    {
        return $this->customFields;
    }

    public function withPurchaseOrderItems(PurchaseOrderItems $items): self
    {
        $result = clone $this;
        $result->purchaseOrderItems = $items;
        return $result;
    }

    public function getPurchaseOrderItems(): PurchaseOrderItems
    {
        return $this->purchaseOrderItems;
    }

    public function withPoCreatedDate(?string $poCreatedDate): self
    {
        $result = clone $this;
        $result->poCreatedDate = $poCreatedDate;
        return $result;
    }

    public function getPoCreatedDate(): ?string
    {
        return $this->poCreatedDate;
    }

    public function withWarehouse(?int $warehouse): self
    {
        $result = clone $this;
        $result->warehouse = $warehouse;
        return $result;
    }

    public function getWarehouse(): ?int
    {
        return $this->warehouse;
    }

    public function withSupplier(?Supplier $supplier): self
    {
        $result = clone $this;
        $result->supplier = $supplier;
        return $result;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function withBaseCurrencyRate(?float $rate): self
    {
        $result = clone $this;
        $result->baseCurrencyRate = $rate;
        return $result;
    }

    public function getBaseCurrencyRate(): ?float
    {
        return $this->baseCurrencyRate;
    }

    public function withBaseCurrency(?string $currency): self
    {
        $result = clone $this;
        $result->baseCurrency = $currency;
        return $result;
    }

    public function getBaseCurrency(): ?string
    {
        return $this->baseCurrency;
    }

    public function withTotal(?string $total): self
    {
        $result = clone $this;
        $result->total = $total;
        return $result;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function withUpdateWarehouseStock(?bool $update): self
    {
        $result = clone $this;
        $result->updateWarehouseStock = $update;
        return $result;
    }

    public function getUpdateWarehouseStock(): ?bool
    {
        return $this->updateWarehouseStock;
    }

    public function withUpdateIncomingOnDraft(?bool $update): self
    {
        $result = clone $this;
        $result->updateIncomingOnDraf = $update;
        return $result;
    }

    public function getUpdateIncomingOnDraft(): ?bool
    {
        return $this->updateIncomingOnDraf;
    }
}
