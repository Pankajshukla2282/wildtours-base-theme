<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

defined('ABSPATH') || exit;

use RuntimeException;
use WildTours\Base\Providers\AdminServiceProvider;
use WildTours\Base\Providers\AssetsServiceProvider;
use WildTours\Base\Providers\BlockServiceProvider;
use WildTours\Base\Providers\CustomizerServiceProvider;
use WildTours\Base\Providers\TemplateServiceProvider;
use WildTours\Base\Providers\ThemeServiceProvider;

/**
 * Theme Application Bootstrap.
 *
 * Boots the dependency injection container and all service providers.
 */
final class Application
{
    /**
     * Application instance.
     */
    private static ?self $instance = null;

    /**
     * Dependency injection container.
     */
    private Container $container;

    /**
     * @var ServiceProvider[]
     */
    private array $providers = [];

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->container = new Container();
    }

    /**
     * Bootstrap the application.
     */
    public static function boot(): self
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }

        self::$instance = new self();

        self::$instance->loadHelpers();

        self::$instance->registerProviders();

        self::$instance->bootProviders();

        return self::$instance;
    }

    /**
     * Return application instance.
     */
    public static function instance(): self
    {
        if (!self::$instance instanceof self) {
            throw new RuntimeException(
                'Application has not been booted.'
            );
        }

        return self::$instance;
    }

    /**
     * Resolve a service from the container.
     */
    public static function make(string $abstract): object
    {
        return self::instance()
            ->container
            ->make($abstract);
    }

    /**
     * Get the container.
     */
    public function container(): Container
    {
        return $this->container;
    }

    /**
     * Register all providers.
     */
    private function registerProviders(): void
    {
        foreach ($this->providers() as $provider) {
            /** @var ServiceProvider $instance */
            $instance = new $provider($this->container);

            $instance->register();

            $this->providers[] = $instance;
        }
    }

    /**
     * Boot all providers.
     */
    private function bootProviders(): void
    {
        foreach ($this->providers as $provider) {
            $provider->boot();
        }
    }

    /**
     * Get service providers.
     *
     * @return array<class-string<\WildTours\Base\Core\ServiceProvider>>
     */
    protected function providers(): array
    {
        $providers = [
            ThemeServiceProvider::class,
            AssetsServiceProvider::class,
            TemplateServiceProvider::class,
            BlockServiceProvider::class,
            CustomizerServiceProvider::class,
            AdminServiceProvider::class,
        ];

        /**
         * Allow child themes or plugins to modify the provider list.
         */
        return apply_filters(
            'wildtours/base/providers',
            $providers
        );
    }

    /**
     * Load helper files.
     */
    private function loadHelpers(): void
    {
        $helpers = glob(
            \WildTours\Base\Support\Theme::appPath('Helpers/*.php')
        );

        if ($helpers === false) {
            return;
        }

        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }

}