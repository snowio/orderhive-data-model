<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\PurchaseOrder\ReceivePurchaseOrder;

final class ReceivePurchaseOrderCommand
{
    public static function of(ReceivePurchaseOrder $receivePO): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->receivePO = $receivePO;
        return $orderUpdateCommand;
    }

    public static function fromJson(array $json): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->receivePO = ReceivePurchaseOrder::fromJson($json);
        return $orderUpdateCommand;
    }

    public function getReceivePurchaseOrder(): ReceivePurchaseOrder
    {
        return $this->receivePO;
    }

    public function toJson(): array
    {
        return $this->receivePO->toJson();
    }

    /** @var ReceivePurchaseOrder */
    private $receivePO;

    private function __construct()
    {

    }
}