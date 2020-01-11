<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Order\Order;

final class DeleteOrderCommand
{
    public static function of(array $orderIds): self
    {
        $deleteCommand = new self;
        $deleteCommand->orderIds = $orderIds;
        return $deleteCommand;
    }

    public static function fromJson(array $json): self
    {
        $deleteCommand = new self;
        $deleteCommand->orderIds = $json['sales_orders_id'];
        return $deleteCommand;
    }

    public function toJson(): array
    {
        return [
            'sales_orders_id' => $this->orderIds
        ];
    }

    /** @var  */
    private $orderIds;

    private function __construct()
    {

    }
}