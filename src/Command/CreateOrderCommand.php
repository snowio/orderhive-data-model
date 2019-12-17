<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Order\Order;

final class CreateOrderCommand
{
    public static function of(Order $order): self
    {
        $createOrderCommand = new self;
        $createOrderCommand->order = $order;
        return $createOrderCommand;
    }

    public static function fromJson(array $json): self
    {
        $createOrderCommand = new self;
        $createOrderCommand->order = Order::fromJson($json);
        return $createOrderCommand;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function toJson(): array
    {
        return [
            $this->order->toJson(),
        ];
    }

    /** @var  */
    private $order;

    private function __construct()
    {

    }
}