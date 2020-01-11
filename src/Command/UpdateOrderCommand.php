<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Order\EditOrder;

final class UpdateOrderCommand
{
    public static function of(EditOrder $order): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->editOrder = $order;
        return $orderUpdateCommand;
    }

    public static function fromJson(array $json): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->editOrder = EditOrder::fromJson($json);
        return $orderUpdateCommand;
    }

    public function getEditOrder(): EditOrder
    {
        return $this->editOrder;
    }

    public function toJson(): array
    {
        return $this->editOrder->toJson();
    }

    /** @var EditOrder */
    private $editOrder;

    private function __construct()
    {

    }
}