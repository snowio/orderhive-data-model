<?php


namespace SnowIO\OrderHiveDataModel\Test\Unit\Command;


use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Command\CreateShipmentCommand;
use SnowIO\OrderHiveDataModel\Shipment\Create\ItemSet;
use SnowIO\OrderHiveDataModel\Shipment\Create\Shipment;

class CreateShipmentCommandTest extends TestCase
{
    public function testModelConsistency()
    {
        $createShipmentCommand = CreateShipmentCommand::fromJson(
            $json = self::getJson(dirname(__DIR__) . '/Shipment/sample.json')
        );

        $expected = $this->getShipment($json);
        self::assertEquals($expected->toJson(), $createShipmentCommand->getShipment()->toJson());
        self::assertTrue($expected->equals($createShipmentCommand->getShipment()));
    }

    private function getShipment(array $json)
    {
        return Shipment::create()
            ->withTrackingNumber($json['tracking_number'])
            ->withShippingCost($json['shipping_cost'])
            ->withOrderCurrency($json['order_currency'])
            ->withShippingMethod($json['shipping_method'])
            ->withCourierName($json['courier_name'])
            ->withShippingDate($json['shipping_date'])
            ->withSalesOrderId($json['sales_order_id'])
            ->withWarehouseId($json['warehouse_id'])
            ->withLabelUrl($json['label_url'])
            ->withPackageWeight($json['package_weight'])
            ->withPackageWeightUnit($json['package_weight_unit'])
            ->withLength($json['length'])
            ->withWidth($json['width'])
            ->withHeight($json['height'])
            ->withDimensionUnit($json['dimension_unit'])
            ->withItems(ItemSet::fromJson($json['items']));
    }

    private static function getJson(string $location)
    {
        return json_decode(file_get_contents($location), true);
    }
}