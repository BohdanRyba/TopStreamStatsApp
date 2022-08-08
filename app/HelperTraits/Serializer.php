<?php

declare(strict_types=1);
namespace App\HelperTraits;

trait Serializer
{
    /**
     * @param array $data
     * @return bool|string
     */
    public function serialize(array $data = []): bool|string
    {
        return json_encode($data);
    }

    /**
     * @param string $data
     * @return array
     */
    public function unserialize(string $data = ""): array
    {
        return json_decode($data, true);
    }

    /**
     * @param mixed|null $data
     * @return array
     */
    public function toArray(mixed $data = null): array
    {
        return $this->unserialize($this->serialize($data));
    }
}
