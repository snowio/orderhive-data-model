<?php

namespace SnowIO\OrderHiveDataModel\Order;

class TaxInfo
{
    public static function of(?int $id): self
    {
        $item = new self($id);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['id'] ?? null)
            ->withTaxRate($json['tax_rate'] ?? null)
            ->withGroups(TaxInfoGroupSet::fromJson($json['groups'] ?? []));
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'tax_rate' => $this->taxRate,
            'groups' => $this->groups->toJson()
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof TaxInfo) &&
        ($this->taxRate === $object->taxRate) &&
        ($this->id === $object->id) &&
        ($this->groups->equals($object->groups));
    }

    private $id;
    private $taxRate;
    private $groups;

    private function __construct(?int $id)
    {
        $this->id = $id;
        $this->groups = TaxInfoGroupSet::create();
    }

    /**
     * @param int|null $id
     * @return TaxInfo
     */
    public function withId(?int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $taxRate
     * @return TaxInfo
     */
    public function withTaxRate(?int $taxRate): self
    {
        $result = clone $this;
        $result->taxRate = $taxRate;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getTaxRate(): ?int
    {
        return $this->taxRate;
    }

    /**
     * @param mixed $groups
     * @return TaxInfo
     */
    public function withGroups(TaxInfoGroupSet $groups): self
    {
        $result = clone $this;
        $result->groups = $groups;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getGroups(): TaxInfoGroupSet
    {
        return $this->groups;
    }
}
