<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\PurchaseOrder\Create\PurchaseOrder;

final class CreatePurchaseOrderCommand
{
    public static function of(PurchaseOrder $purchaseOrder): self
    {
        $updateCommand = new self;
        $updateCommand->purchaseOrder = $purchaseOrder;
        return $updateCommand;
    }

    public static function fromJson(array $json): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->purchaseOrder = PurchaseOrder::fromJson($json);
        return $orderUpdateCommand;
    }

    public function getPurchaseOrder(): PurchaseOrder
    {
        return $this->purchaseOrder;
    }

    public function toJson(): array
    {
        return $this->purchaseOrder->toJson();
    }

    /** @var PurchaseOrder */
    private $purchaseOrder;

    private function __construct()
    {
    }
}
