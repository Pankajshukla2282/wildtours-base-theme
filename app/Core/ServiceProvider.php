<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

defined('ABSPATH') || exit;

/**
 * Base class for all service providers.
 *
 * Service providers register and bootstrap theme services.
 * They should not contain business logic or presentation code.
 */
abstract class ServiceProvider
{
    /**
     * Dependency injection container.
     */
    protected Container $container;

    /**
     * Constructor.
     */
    final public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Register bindings in the container.
     *
     * Register singletons, bindings and shared services here.
     */
    public function register(): void
    {
        // Override in child providers if required.
    }

    /**
     * Bootstrap the provider.
     *
     * Register WordPress hooks, filters and initialization code here.
     */
    public function boot(): void
    {
        // Override in child providers if required.
    }

    /**
     * Resolve an object from the container.
     */
    final protected function make(string $abstract): object
    {
        return $this->container->make($abstract);
    }

    /**
     * Register a binding.
     */
    final protected function bind(
        string $abstract,
        string|callable $concrete
    ): void {
        $this->container->bind($abstract, $concrete);
    }

    /**
     * Register a singleton.
     */
    final protected function singleton(
        string $abstract,
        string|callable $concrete
    ): void {
        $this->container->singleton($abstract, $concrete);
    }

    /**
     * Register an existing instance.
     */
    final protected function instance(
        string $abstract,
        object $instance
    ): void {
        $this->container->instance($abstract, $instance);
    }

    /**
     * Get the container instance.
     */
    final protected function container(): Container
    {
        return $this->container;
    }
}