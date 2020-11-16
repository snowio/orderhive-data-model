<?php

namespace SnowIO\OrderHiveDataModel\Order\OrderDetails;

class Address
{
    public static function of(?int $id)
    {
        $item = new self($id);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson(array $json)
    {
        return self::of($json['id'] ?? null)
            ->withAddress1($json['address1'] ?? null)
            ->withAddress2($json['address2'] ?? null)
            ->withCity($json['city'] ?? null)
            ->withCompany($json['company'] ?? null)
            ->withContactNumber($json['contact_number'] ?? null)
            ->withCountry($json['country'] ?? null)
            ->withCountryCode($json['country_code'] ?? null)
            ->withEmail($json['email'] ?? null)
            ->withName($json['name'] ?? null)
            ->withState($json['state'] ?? null)
            ->withDefault($json['default'] ?? null)
            ->withZipcode($json['zipcode'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'company' => $this->company,
            'contact_number' => $this->contactNumber,
            'country' => $this->country,
            'country_code' => $this->countryCode,
            'email' => $this->email,
            'name' => $this->name,
            'state' => $this->state,
            'default' => $this->default,
            'zipcode' => $this->zipcode,
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Address) &&
        ($this->address1 === $object->address1) &&
        ($this->address2 === $object->address2) &&
        ($this->city === $object->city) &&
        ($this->company === $object->company) &&
        ($this->contactNumber === $object->contactNumber) &&
        ($this->country === $object->country) &&
        ($this->countryCode === $object->countryCode) &&
        ($this->created === $object->created) &&
        ($this->email === $object->email) &&
        ($this->id === $object->id) &&
        ($this->modified === $object->modified) &&
        ($this->name === $object->name) &&
        ($this->state === $object->state) &&
        ($this->default === $object->default) &&
        ($this->zipcode === $object->zipcode);
    }

    protected $address1;
    protected $address2;
    protected $city;
    protected $company;
    protected $contactNumber;
    protected $country;
    protected $countryCode;
    protected $created;
    protected $email;
    protected $id;
    protected $modified;
    protected $name;
    protected $state;
    protected $zipcode;
    protected $default;

    protected function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function withAddress1(?string $address1): self
    {
        $result = clone $this;
        $result->address1 = $address1;
        return $result;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function withAddress2(?string $address2): self
    {
        $result = clone $this;
        $result->address2 = $address2;
        return $result;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function withCity(?string $city): self
    {
        $result = clone $this;
        $result->city = $city;
        return $result;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function withCompany($company): self
    {
        $result = clone $this;
        $result->company = $company;
        return $result;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function withContactNumber(?string $contactNumber): self
    {
        $result = clone $this;
        $result->contactNumber = $contactNumber;
        return $result;
    }

    public function getContactNumber(): ?string
    {
        return $this->contactNumber;
    }

    public function withCountry(?string $country): self
    {
        $result = clone $this;
        $result->country = $country;
        return $result;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function withCountryCode(?string $countryCode): self
    {
        $result = clone $this;
        $result->countryCode = $countryCode;
        return $result;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function withCreated(?string $created): self
    {
        $result = clone $this;
        $result->created = $created;
        return $result;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function withEmail(?string $email): self
    {
        $result = clone $this;
        $result->email = $email;
        return $result;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function withId(?int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function withModified(?string $modified): self
    {
        $result = clone $this;
        $result->modified = $modified;
        return $result;
    }

    public function getModified(): ?string
    {
        return $this->modified;
    }

    public function withName(?string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function withState(?string $state)
    {
        $result = clone $this;
        $result->state = $state;
        return $result;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function withZipcode(?string $zipcode): self
    {
        $result = clone $this;
        $result->zipcode = $zipcode;
        return $result;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function withDefault($default): self
    {
        $result = clone $this;
        $result->default = $default;
        return $result;
    }

    public function getDefault()
    {
        return $this->default;
    }
}
