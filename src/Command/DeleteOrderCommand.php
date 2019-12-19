<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Order\Order;

final class DeleteOrderCommand
{
    public static function of(Order $order): self
    {
        $deleteCommand = new self;
        $deleteCommand->salesOrdersId[] = $order->getId();
        return $deleteCommand;
    }

    public static function fromJson(array $json): self
    {
        $deleteCommand = new self;
        $deleteCommand->salesOrdersId = $json['sales_orders_id'];
        return $deleteCommand;
    }

    public function toJson(): array
    {
        return [
            'sales_orders_id' => $this->salesOrdersId
        ];
    }

    /** @var  */
    private $salesOrdersId;

    private function __construct()
    {

    }
}