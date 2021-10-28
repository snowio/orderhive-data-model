<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Shipment\Create;

class Shipment
{
	private $json;
	private $items;

	public static function fromJson(array $json): self
	{
		$result = new self;
		$result->json = $json;
		unset($result->json['items']);
		$result->items = ItemSet::fromJson($json['items'] ?? []);
		return $result;
	}

    public static function create(): self
    {
        return new self;
    }

    public function withTrackingNumber(string $trackingNumber): self
	{
		$result = clone $this;
		$result->json['tracking_number'] = $trackingNumber;
		return $result;
	}

	public function withShippingCost(string $shippingCost): self
	{
		$result = clone $this;
		$result->json['shipping_cost'] = $shippingCost;
		return $result;
	}

	public function withOrderCurrency(string $orderCurrency): self
	{
		$result = clone $this;
		$result->json['order_currency'] = $orderCurrency;
		return $result;
	}

	public function withShippingMethod(string $shippingMethod): self
	{
		$result = clone $this;
		$result->json['shipping_method'] = $shippingMethod;
		return $result;
	}

	public function withCourierName(string $courierName): self
	{
		$result = clone $this;
		$result->json['courier_name'] = $courierName;
		return $result;
	}

	public function withShippingDate(string $shippingDate): self
	{
		$result = clone $this;
		$result->json['shipping_date'] = $shippingDate;
		return $result;
	}

	public function withSalesOrderId(int $salesOrderId): self
	{
		$result = clone $this;
		$result->json['sales_order_id'] = $salesOrderId;
		return $result;
	}

	public function withWarehouseId(int $warehouseId): self
	{
		$result = clone $this;
		$result->json['warehouse_id'] = $warehouseId;
		return $result;
	}

	public function withLabelUrl(string $labelUrl): self
	{
		$result = clone $this;
		$result->json['label_url'] = $labelUrl;
		return $result;
	}

	public function withPackageWeight(string $packageWeight): self
	{
		$result = clone $this;
		$result->json['package_weight'] = $packageWeight;
		return $result;
	}

	public function withPackageWeightUnit(string $packageWeightUnit): self
	{
		$result = clone $this;
		$result->json['package_weight_unit'] = $packageWeightUnit;
		return $result;
	}

	public function withLength(string $length): self
	{
		$result = clone $this;
		$result->json['length'] = $length;
		return $result;
	}

	public function withWidth(string $width): self
	{
		$result = clone $this;
		$result->json['width'] = $width;
		return $result;
	}

	public function withHeight(string $height): self
	{
		$result = clone $this;
		$result->json['height'] = $height;
		return $result;
	}

	public function withDimensionUnit(string $dimensionUnit): self
	{
		$result = clone $this;
		$result->json['dimension_unit'] = $dimensionUnit;
		return $result;
	}

	public function withItems(ItemSet $items): self
	{
		$result = clone $this;
		$result->items = $items;
		return $result;
	}

	public function getTrackingNumber(): string
	{
		return $this->json['tracking_number'];
	}

	public function getShippingCost(): string
	{
		return $this->json['shipping_cost'];
	}

	public function getOrderCurrency(): string
	{
		return $this->json['order_currency'];
	}

	public function getShippingMethod(): string
	{
		return $this->json['shipping_method'];
	}

	public function getCourierName(): string
	{
		return $this->json['courier_name'];
	}

	public function getShippingDate(): string
	{
		return $this->json['shipping_date'];
	}

	public function getSalesOrderId(): int
	{
		return $this->json['sales_order_id'];
	}

	public function getWarehouseId(): int
	{
		return $this->json['warehouse_id'];
	}

	public function getLabelUrl(): string
	{
		return $this->json['label_url'];
	}

	public function getPackageWeight(): string
	{
		return $this->json['package_weight'];
	}

	public function getPackageWeightUnit(): string
	{
		return $this->json['package_weight_unit'];
	}

	public function getLength(): string
	{
		return $this->json['length'];
	}

	public function getWidth(): string
	{
		return $this->json['width'];
	}

	public function getHeight(): string
	{
		return $this->json['height'];
	}

	public function getDimensionUnit(): string
	{
		return $this->json['dimension_unit'];
	}

	public function getItems(): ItemSet
	{
		return $this->items;
	}

	public function toJson(): array
	{
	    $json = $this->json;
	    $json['items'] = $this->items->toJson();
	    return $json;
	}

	private function __construct()
	{
        $this->items = ItemSet::create();
    }

    public function equals($other)
    {
        return $other instanceof self && $other->json === $this->json && $other->items->equals($this->items);
    }
}
