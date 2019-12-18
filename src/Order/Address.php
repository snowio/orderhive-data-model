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

    public static function fromJson($json): self
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
     * @return BillingAddress
     */
    public function withAddress1($address1)
    {
        $result = clone $this;
        $result->address1 = $address1;
        return $result;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param string $address2
     * @return BillingAddress
     */
    public function withAddress2($address2)
    {
        $result = clone $this;
        $result->address2 = $address2;
        return $result;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $city
     * @return BillingAddress
     */
    public function withCity($city)
    {
        $result = clone $this;
        $result->city = $city;
        return $result;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $company
     * @return BillingAddress
     */
    public function withCompany($company)
    {
        $result = clone $this;
        $result->company = $company;
        return $result;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $contactNumber
     * @return BillingAddress
     */
    public function withContactNumber($contactNumber)
    {
        $result = clone $this;
        $result->contactNumber = $contactNumber;
        return $result;
    }

    /**
     * @return string
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * @param string $country
     * @return BillingAddress
     */
    public function withCountry($country)
    {
        $result = clone $this;
        $result->country = $country;
        return $result;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $countryCode
     * @return BillingAddress
     */
    public function withCountryCode($countryCode)
    {
        $result = clone $this;
        $result->countryCode = $countryCode;
        return $result;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $created
     * @return BillingAddress
     */
    public function withCreated($created)
    {
        $result = clone $this;
        $result->created = $created;
        return $result;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $email
     * @return BillingAddress
     */
    public function withEmail($email)
    {
        $result = clone $this;
        $result->email = $email;
        return $result;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param int $id
     * @return BillingAddress
     */
    public function withId(int $id): BillingAddress
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
     * @param string $modified
     * @return BillingAddress
     */
    public function withModified($modified)
    {
        $result = clone $this;
        $result->modified = $modified;
        return $result;
    }

    /**
     * @return string
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param string $name
     * @return BillingAddress
     */
    public function withName($name)
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $state
     * @return BillingAddress
     */
    public function withState($state)
    {
        $result = clone $this;
        $result->state = $state;
        return $result;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $zipcode
     * @return BillingAddress
     */
    public function withZipcode($zipcode)
    {
        $result = clone $this;
        $result->zipcode = $zipcode;
        return $result;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }
}