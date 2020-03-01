<?php

namespace SnowIO\OrderHiveDataModel\Order\OrderDetails;

use SnowIO\OrderHiveDataModel\Order\Warehouse as BaseWarehouse;

class Warehouse extends BaseWarehouse
{
    private function __construct($id)
    {
        $this->id = $id;
    }

    public static function of($id)
    {
        $item = new self($id);
        return $item;
    }

    public static function fromJson($json): self
    {
        return self::of($json['id'] ?? null)
            ->withIsDefault($json['is_default'] ?? null)
            ->withName($json['name'] ?? null)
            ->withType($json['type'] ?? null)
            ->withCountryName($json['country_name'] ?? null)
            ->withcontactNo($json['contact_no'] ?? null)
            ->withdropShipperPolicy($json['dropshipper_policy'] ?? null);
    }

    public function toJson(): array
    {
        return array_merge(parent::toJson(), [
            "name" => $this->name,
            "type" => $this->type,
            "country_name" => $this->countryName,
            "contact_no" => $this->contactNo,
            "dropshipper_policy" => $this->dropShipperPolicy
        ]);
    }

    public function equals($object): bool
    {
        return parent::equals($object) &&
        ($this->name === $object->name) &&
        ($this->type === $object->type) &&
        ($this->countryName === $object->countryName) &&
        ($this->contactNo === $object->contactNo) &&
        ($this->dropShipperPolicy === $object->dropShipperPolicy);
    }

    private $name;
    private $type;
    private $countryName;
    private $contactNo;
    private $dropShipperPolicy;

    public function getName()
    {
        return $this->name;
    }

    public function withName($name)
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function getType()
    {
        return $this->type;
    }

    public function withType($type)
    {
        $result = clone $this;
        $result->type = $type;
        return $result;
    }

    public function getCountryName()
    {
        return $this->countryName;
    }

    public function withCountryName($countryName)
    {
        $result = clone $this;
        $result->countryName = $countryName;
        return $result;
    }

    public function getContactNo()
    {
        return $this->contactNo;
    }

    public function withContactNo($contactNo)
    {
        $result = clone $this;
        $result->contactNo = $contactNo;
        return $result;
    }

    public function getDropShipperPolicy()
    {
        return $this->dropShipperPolicy;
    }

    public function withDropShipperPolicy($dropShipperPolicy)
    {
        $result = clone $this;
        $result->dropShipperPolicy = $dropShipperPolicy;
        return $result;
    }


}
