<?php

namespace SnowIO\OrderHiveDataModel\Order;

class Address
{
    public static function of(?int $id): self
    {
        $item = new self($id);
        return $item;
    }

    /**
     * @return static
     */
    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson(array $json): self
    {
        return self::of($json['id'] ?? null)
            ->withAddress1($json['address1'] ?? null)
            ->withAddress2($json['address2'] ?? null)
            ->withCity($json['city'] ?? null)
            ->withCompany($json['company'] ?? null)
            ->withContactNumber($json['contact_number'] ?? null)
            ->withCountry($json['country'] ?? null)
            ->withCountryCode($json['country_code'] ?? null)
            ->withCreated($json['created'] ?? null)
            ->withEmail($json['email'] ?? null)
            ->withModified($json['modified'] ?? null)
            ->withName($json['name'] ?? null)
            ->withState($json['state'] ?? null)
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
            'created' => $this->created,
            'email' => $this->email,
            'id' => $this->id,
            'modified' => $this->modified,
            'name' => $this->name,
            'state' => $this->state,
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
        ($this->zipcode === $object->zipcode);
    }

    private $address1;
    private $address2;
    private $city;
    private $company;
    private $contactNumber;
    private $country;
    private $countryCode;
    private $created;
    private $email;
    private $id;
    private $modified;
    private $name;
    private $state;
    private $zipcode;

    private function __construct(?int $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $address1
     * @return Address
     */
    public function withAddress1(?string $address1): self
    {
        $result = clone $this;
        $result->address1 = $address1;
        return $result;
    }

    /**
     * @return string
     */
    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    /**
     * @param string $address2
     * @return Address
     */
    public function withAddress2(?string $address2): self
    {
        $result = clone $this;
        $result->address2 = $address2;
        return $result;
    }

    /**
     * @return string
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function withCity(?string $city): self
    {
        $result = clone $this;
        $result->city = $city;
        return $result;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $company
     * @return Address
     */
    public function withCompany($company): self
    {
        $result = clone $this;
        $result->company = $company;
        return $result;
    }

    /**
     * @return string
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string $contactNumber
     * @return Address
     */
    public function withContactNumber(?string $contactNumber): self
    {
        $result = clone $this;
        $result->contactNumber = $contactNumber;
        return $result;
    }

    /**
     * @return string
     */
    public function getContactNumber(): ?string
    {
        return $this->contactNumber;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function withCountry(?string $country): self
    {
        $result = clone $this;
        $result->country = $country;
        return $result;
    }

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $countryCode
     * @return Address
     */
    public function withCountryCode(?string $countryCode): self
    {
        $result = clone $this;
        $result->countryCode = $countryCode;
        return $result;
    }

    /**
     * @return string
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string $created
     * @return Address
     */
    public function withCreated(?string $created): self
    {
        $result = clone $this;
        $result->created = $created;
        return $result;
    }

    /**
     * @return string
     */
    public function getCreated(): ?string
    {
        return $this->created;
    }

    /**
     * @param string $email
     * @return Address
     */
    public function withEmail(?string $email): self
    {
        $result = clone $this;
        $result->email = $email;
        return $result;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param int $id
     * @return Address
     */
    public function withId(int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string|null $modified
     * @return Address
     */
    public function withModified(?string $modified): self
    {
        $result = clone $this;
        $result->modified = $modified;
        return $result;
    }

    /**
     * @return string
     */
    public function getModified(): ?string
    {
        return $this->modified;
    }

    /**
     * @param string|null $name
     * @return Address
     */
    public function withName(?string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $state
     * @return Address
     */
    public function withState(?string $state): self
    {
        $result = clone $this;
        $result->state = $state;
        return $result;
    }

    /**
     * @return string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $zipcode
     * @return Address
     */
    public function withZipcode(?string $zipcode): self
    {
        $result = clone $this;
        $result->zipcode = $zipcode;
        return $result;
    }

    /**
     * @return string
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }
}