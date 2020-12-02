<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\PurchaseOrder;

final class EditPurchaseOrder
{
    public static function of(int $id): self
    {
        $order = new self($id);
        $order->customFields = CustomFieldsSet::create();
        return $order;
    }

    public static function fromJson(array $json): self
    {
        $result = self::of($json['id']);
        $result->paymentTerm = $json['payment_term'] ?? null;
        $result->note = $json['note'] ?? null;
        $result->expectedDate = $json['expected_date'] ?? null;

        $result->customFields = isset($json['custom_fields'])
            ? CustomFieldsSet::fromJson($json['custom_fields'])
            : CustomFieldsSet::create();

        return $result;
    }

    public function toJson(): array
    {
        $json = [
            'id' => $this->id,
            'payment_term' => $this->paymentTerm,
            'note' => $this->note,
            'expected_date' => $this->expectedDate,
        ];

        if ($this->customFields->count()) {
            $json += ['custom_fields' => $this->customFields->toJson()];
        }

        return array_filter($json);
    }

    public function equals(EditPurchaseOrder $object): bool
    {
        return ($object instanceof EditPurchaseOrder) &&
        ($this->id === $object->id) &&
        ($this->paymentTerm === $object->paymentTerm) &&
        ($this->expectedDate === $object->expectedDate) &&
        ($this->note === $object->note) &&
        ($this->customFields->equals($object->customFields));
    }

    private $id;
    private $paymentTerm;
    private $note;
    private $expectedDate;
    /** @var CustomFieldsSet */
    private $customFields;

    private function __construct($id)
    {
        $this->id = $id;
    }

    public function withPaymentTerm(?string $paymentTerm): self
    {
        $result = clone $this;
        $result->paymentTerm = $paymentTerm;
        return $result;
    }

    public function getPaymentTerm() :?string
    {
        return $this->paymentTerm;
    }

    public function withExpectedDate(?string $expectedDate): self
    {
        $result = clone $this;
        $result->expectedDate = $expectedDate;
        return $result;
    }

    public function getExpectedDate(): ?string
    {
        return $this->expectedDate;
    }

    public function withNote($note): self
    {
        $result = clone $this;
        $result->note = $note;
        return $result;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function withCustomFields(CustomFieldsSet $customFields): self
    {
        $result = clone $this;
        $result->customFields = $customFields;
        return $result;
    }

    public function getCustomFields(): CustomFieldsSet
    {
        return $this->customFields;
    }

    public function withId(int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
