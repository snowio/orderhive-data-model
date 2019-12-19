<?php

namespace SnowIO\OrderHiveDataModel\Order;

class ProductImage
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
            ->withUrl($json['url'] ?? null)
            ->withDefaultImage($json['default_image'] ?? null)
            ->withThumbnail($json['thumbnail'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'default_image' => $this->defaultImage,
            'thumbnail' => $this->thumbnail,
            'url' => $this->url,
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof ProductImage) &&
        ($this->defaultImage === $object->defaultImage) &&
        ($this->id === $object->id) &&
        ($this->url === $object->url) &&
        ($this->thumbnail === $object->thumbnail);
    }

    private $id;
    private $defaultImage;
    private $thumbnail;
    private $url;

    private function __construct(?int $id)
    {
        $this->id = $id;
    }

    /**
     * @param int|null $id
     * @return ProductImage
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
     * @param string|null $url
     * @return ProductImage
     */
    public function withUrl(?string $url): self
    {
        $result = clone $this;
        $result->url = $url;
        return $result;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $thumbnail
     * @return ProductImage
     */
    public function withThumbnail(?string $thumbnail): self
    {
        $result = clone $this;
        $result->thumbnail = $thumbnail;
        return $result;
    }

    /**
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param string|null $defaultImage
     * @return ProductImage
     */
    public function withDefaultImage(?string $defaultImage): self
    {
        $result = clone $this;
        $result->defaultImage = $defaultImage;
        return $result;
    }

    /**
     * @return string|null
     */
    public function getDefaultImage(): ?string
    {
        return $this->defaultImage;
    }
}
