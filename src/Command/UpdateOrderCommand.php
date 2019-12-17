<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Order\Order;

final class UpdateOrderCommand
{
    public static function of(Order $order): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->order = $order;
        return $orderUpdateCommand;
    }

    public static function fromJson(array $json): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->order = Order::fromJson($json);
        return $orderUpdateCommand;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function toJson(): array
    {
        return $this->order->toJson();
    }

    /** @var  */
    private $order;

    private function __construct()
    {

    }
}