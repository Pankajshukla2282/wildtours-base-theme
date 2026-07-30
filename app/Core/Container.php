<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use RuntimeException;

defined('ABSPATH') || exit;

/**
 * Lightweight dependency injection container.
 */
final class Container
{
    /**
     * Registered service providers.
     *
     * @var array<int, ServiceProvider>
     */
    private array $providers = [];

    /**
     * Shared instances.
     *
     * @var array<string, object>
     */
    private array $instances = [];

    /**
     * Interface bindings.
     *
     * @var array<string, class-string>
     */
    private array $bindings = [];

    /**
     * Register a service provider.
     */
    public function register(string $provider): void
    {
        foreach ($this->providers as $registered) {
            if ($registered instanceof $provider) {
                return;
            }
        }

        $this->providers[] = new $provider($this);
    }

    /**
     * Boot all providers.
     */
    public function boot(): void
    {
        foreach ($this->providers as $provider) {

            $provider->register();

            $provider->boot();
        }
    }

    /**
     * Bind an abstraction.
     *
     * Example:
     *
     * $container->bind(
     *     MailerInterface::class,
     *     WPMailer::class
     * );
     */
    public function bind(string $abstract, string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    /**
     * Register an existing instance.
     */
    public function instance(string $abstract, object $instance): void
    {
        $this->instances[$abstract] = $instance;
    }

    /**
     * Register a singleton.
     */
    public function singleton(string $abstract, string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;

        if (!isset($this->instances[$abstract])) {
            $this->instances[$abstract] = $this->build($concrete);
        }
    }

    /**
     * Resolve a class.
     *
     * @throws RuntimeException
     */
    public function make(string $abstract): object
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $concrete = $this->bindings[$abstract] ?? $abstract;

        return $this->build($concrete);
    }

    /**
     * Build an object using reflection.
     *
     * @throws RuntimeException
     */
    private function build(string $class): object
    {
        try {
            $reflection = new ReflectionClass($class);
        } catch (ReflectionException $exception) {
            throw new RuntimeException(
                sprintf('Unable to resolve [%s].', $class),
                0,
                $exception
            );
        }

        if (!$reflection->isInstantiable()) {
            throw new RuntimeException(
                sprintf('Class [%s] is not instantiable.', $class)
            );
        }

        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new $class();
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $parameter) {

            $type = $parameter->getType();

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {

                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                    continue;
                }

                throw new RuntimeException(
                    sprintf(
                        'Unable to resolve parameter [$%s] in [%s].',
                        $parameter->getName(),
                        $class
                    )
                );
            }

            $dependencies[] = $this->make($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }

    /**
     * Determine whether an abstraction is registered.
     */
    public function has(string $abstract): bool
    {
        return isset($this->instances[$abstract])
            || isset($this->bindings[$abstract]);
    }
}