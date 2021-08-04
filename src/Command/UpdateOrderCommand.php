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

    /**
     * Only return the specified keys which allow us to field specific
     * updates and not empty other data
     * @param $keys
     * @return array
     */
    public function toJsonFiltered($keys): array
    {
        $json = $this->editOrder->toJson();
        return array_filter($json, function ($value, $key) use ($keys){
            return in_array($key, $keys) ? [$key => $value] : null;
        }, ARRAY_FILTER_USE_BOTH);
    }

    /** @var EditOrder */
    private $editOrder;

    private function __construct()
    {
    }
}
