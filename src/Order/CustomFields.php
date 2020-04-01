<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class CustomFields
{
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

    private function __construct($name, $type, $value)
    {
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
