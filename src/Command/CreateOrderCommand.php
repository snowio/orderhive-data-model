<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Order\CreateOrder;

final class CreateOrderCommand
{
    public static function of(CreateOrder $createOrder): self
    {
        $createOrderCommand = new self;
        $createOrderCommand->createOrder = $createOrder;
        return $createOrderCommand;
    }

    public static function fromJson(array $json): self
    {
        $createOrderCommand = new self;
        $createOrderCommand->createOrder = CreateOrder::fromJson($json);
        return $createOrderCommand;
    }

    public function getCreateOrder()
    {
        return $this->createOrder;
    }

    public function toJson(): array
    {
        return $this->createOrder->toJson();
    }

    /** @var CreateOrder $order */
    private $createOrder;

    private function __construct()
    {
    }
}
