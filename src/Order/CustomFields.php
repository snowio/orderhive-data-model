<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

use SnowIO\OrderHiveDataModel\OrderHiveDataException;

final class CustomFields
{
    const TYPE_TEXT = 'TEXT';
    const TYPE_DROP_DOWN = 'DROP_DOWN';
    const TYPE_DATE = 'DATE';
    const TYPE_CHECKBOX = 'CHECKBOX';
    const TYPE_NUMBER = 'NUMBER';

    public static function of($name, $type, $value): self
    {
        return (new self($name, $type, $value));
    }

    public static function fromJson($json): self
    {
        $result = self::of($json['name'], $json['type'], $json['value']);
        return $result;
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value
        ];
    }

    /**
     * @param CustomFields $object
     * @return bool
     */
    public function equals($object): bool
    {
        return ($object instanceof CustomFields) &&
        ($this->name === $object->name) &&
        ($this->type === $object->type) &&
        ($this->value === $object->value);
    }

    private $name;
    private $type;
    private $value;

    private function validateType(string $type): bool
    {
        return in_array($type, [
            self::TYPE_TEXT,
            self::TYPE_CHECKBOX,
            self::TYPE_DATE,
            self::TYPE_DROP_DOWN,
            self::TYPE_NUMBER
        ]);
    }

    private function __construct($name, $type, $value)
    {
        if (!$this->validateType($type)) {
            throw new OrderHiveDataException($type . ' is not a valid custom field type');
        }

        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function withName(string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function withType($type)
    {
        $result = clone $this;
        $result->type = $type;
        return $result;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function witValue($value): self
    {
        $result = clone $this;
        $result->value = $value;
        return $result;
    }

    public function getValue()
    {
        return $this->value;
    }
}
