<?php

declare(strict_types=1);

namespace Component\Registry;

interface ServiceRegistryInterface
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param string $identifier
     * @param object $service
     *
     * @throws ExistingServiceException
     * @throws \InvalidArgumentException
     */
    public function register(string $identifier, $service): void;

    /**
     * @param string $identifier
     *
     * @throws NonExistingServiceException
     */
    public function unregister(string $identifier): void;

    /**
     * @param string $identifier
     *
     * @return bool
     */
    public function has(string $identifier): bool;

    /**
     * @param string $identifier
     *
     * @return object
     *
     * @throws NonExistingServiceException
     */
    public function get(string $identifier);
}
