<?php

declare(strict_types=1);

namespace Component\Resource\Storage;

interface StorageInterface
{
    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null);

    /**
     * @param string $name
     * @param mixed $value
     */
    public function set(string $name, $value): void;

    /**
     * @param string $name
     */
    public function remove(string $name): void;

    /**
     * @return array
     */
    public function all(): array;
}
