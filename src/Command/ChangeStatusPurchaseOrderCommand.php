<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\PurchaseOrder\ChangeStatusPurchaseOrder;

final class ChangeStatusPurchaseOrderCommand
{
    public static function of(ChangeStatusPurchaseOrder $purchaseOrder): self
    {
        $updateCommand = new self;
        $updateCommand->changeStatus = $purchaseOrder;
        return $updateCommand;
    }

    public static function fromJson(array $json): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->changeStatus = ChangeStatusPurchaseOrder::fromJson($json);
        return $orderUpdateCommand;
    }

    public function getChangeStatusPurchaseOrder(): ChangeStatusPurchaseOrder
    {
        return $this->changeStatus;
    }

    public function toJson(): array
    {
        return $this->changeStatus->toJson();
    }

    /** @var ChangeStatusPurchaseOrder */
    private $changeStatus;

    private function __construct()
    {
    }
}
