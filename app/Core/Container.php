<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

use Closure;
use RuntimeException;

final class Container
{
    /**
     * Shared instances.
     *
     * @var array<string, object>
     */
    private array $instances = [];

    /**
     * Service bindings.
     *
     * @var array<string, Closure>
     */
    private array $bindings = [];

    /**
     * Register a singleton instance.
     */
    public function singleton(string $id, object $instance): void
    {
        $this->instances[$id] = $instance;
    }

    /**
     * Register a lazy-loaded service.
     */
    public function bind(string $id, Closure $resolver): void
    {
        $this->bindings[$id] = $resolver;
    }

    /**
     * Resolve a service.
     */
    public function make(string $id): object
    {
        if ($this->has($id)) {
            return $this->instances[$id];
        }

        if (! isset($this->bindings[$id])) {
            throw new RuntimeException(
                sprintf(
                    'Service "%s" has not been registered.',
                    $id
                )
            );
        }

        $instance = ($this->bindings[$id])($this);

        $this->singleton($id, $instance);

        return $instance;
    }

    /**
     * Get an existing singleton.
     */
    public function get(string $id): ?object
    {
        return $this->instances[$id] ?? null;
    }

    /**
     * Determine if a singleton exists.
     */
    public function has(string $id): bool
    {
        return isset($this->instances[$id]);
    }
}