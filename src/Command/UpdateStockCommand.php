<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;

use SnowIO\OrderHiveDataModel\Product\UpdateStock;

final class UpdateStockCommand
{
    public static function of(UpdateStock $updateStock): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->updateStock = $updateStock;
        return $orderUpdateCommand;
    }

    public static function fromJson(array $json): self
    {
        $orderUpdateCommand = new self;
        $orderUpdateCommand->updateStock = UpdateStock::fromJson($json);
        return $orderUpdateCommand;
    }

    public function getUpdateStock(): UpdateStock
    {
        return $this->updateStock;
    }

    public function toJson(): array
    {
        return $this->updateStock->toJson();
    }

    /** @var UpdateStock */
    private $updateStock;

    private function __construct()
    {

    }
}