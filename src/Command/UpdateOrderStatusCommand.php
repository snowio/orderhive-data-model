<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Order\UpdateOrderStatus;

final class UpdateOrderStatusCommand
{
    public static function of(UpdateOrderStatus $orderStatus): self
    {
        $command = new self;
        $command->orderStatus = $orderStatus;
        return $command;
    }

    public static function fromJson(array $json): self
    {
        $command = new self;
        $command->orderStatus = UpdateOrderStatus::fromJson($json);
        return $command;
    }

    public function getUpdateOrderStatus(): UpdateOrderStatus
    {
        return $this->orderStatus;
    }

    public function toJson(): array
    {
        return $this->orderStatus->toJson();
    }

    /** @var UpdateOrderStatus */
    private $orderStatus;

    private function __construct()
    {
    }
}
