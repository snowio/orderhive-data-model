<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\PurchaseOrder\EditPurchaseOrder;

final class UpdatePurchaseOrderCommand
{
    public static function of(EditPurchaseOrder $purchaseOrder): self
    {
        $updateCommand = new self;
        $updateCommand->editPurchaseOrder = $purchaseOrder;
        return $updateCommand;
    }

    public static function fromJson(array $json): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->editPurchaseOrder = EditPurchaseOrder::fromJson($json);
        return $orderUpdateCommand;
    }

    public function getEditPurchaseOrder(): EditPurchaseOrder
    {
        return $this->editPurchaseOrder;
    }

    public function toJson(): array
    {
        return $this->editPurchaseOrder->toJson();
    }

    /** @var EditPurchaseOrder */
    private $editPurchaseOrder;

    private function __construct()
    {
    }
}
