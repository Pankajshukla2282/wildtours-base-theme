<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

abstract class ServiceProvider
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Register all bindings.
     */
    abstract public function register(): void;

    /**
     * Boot all services.
     */
    abstract public function boot(): void;
}