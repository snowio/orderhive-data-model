<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Command;


use SnowIO\OrderHiveDataModel\Shipment\Create\Shipment;

final class CreateShipmentCommand
{
    public static function of(Shipment $shipment)
    {
        $command = new self;
        $command->shipment = $shipment;
        return $shipment;
    }

    public static function fromJson(array $json): self
    {
        $command = new self;
        $command->shipment = Shipment::fromJson($json);
        return $command;
    }

    public function getShipment(): Shipment
    {
        return $this->shipment;
    }

    public function toJson(): array
    {
        return $this->shipment->toJson();
    }

    private $shipment;

    private function __construct()
    {

    }
}
