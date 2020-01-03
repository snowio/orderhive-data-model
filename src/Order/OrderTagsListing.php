<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

final class OrderTagsListing
{
    public static function of($id): self
    {
        $item = (new self($id));
        return $item;
    }

    public static function fromJson($json): self
    {
        $result = self::of($json['id']);
        $result->tagName = $json['tag_name'] ?? null;
        $result->tagColor = $json['tag_color'] ?? null;
        return $result;
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'tag_name' => $this->tagName,
            'tag_color' => $this->tagColor,
        ];
    }

    /**
     * @param OrderTagsListing $object
     * @return bool
     */
    public function equals(OrderTagsListing $object): bool
    {
        return ($object instanceof Item) &&
        ($this->id === $object->id) &&
        ($this->tagName === $object->tagName) &&
        ($this->tagColor === $object->tagColor);
    }

    private $id;
    private $tagName;
    private $tagColor;

    public function getId()
    {
        return $this->id;
    }

    public function withId(string $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    private function __construct($id)
    {
        $this->id = $id;
    }

    public function withTagColor(?string $tagColor): self
    {
        $result = clone $this;
        $result->tagColor = $tagColor;
        return $result;
    }

    public function getTagColor(): ?string
    {
        return $this->tagColor;
    }

    public function withTagName(?string $tagName): self
    {
        $result = clone $this;
        $result->tagName = $tagName;
        return $result;
    }

    public function getTagName(): ?string
    {
        return $this->tagName;
    }


}
