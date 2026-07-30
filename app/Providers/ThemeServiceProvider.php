<?php

declare(strict_types=1);

namespace WildTours\Base\Providers;

use WildTours\Base\Core\Application;
use WildTours\Base\Core\ServiceProvider;
use WildTours\Base\Theme\Hooks;
use WildTours\Base\Theme\ImageManager;
use WildTours\Base\Theme\ThemeSupport;
use WildTours\Base\Theme\WidgetManager;

defined('ABSPATH') || exit;

/**
 * Registers and boots theme services.
 *
 * @package WildTours\Base
 */
final class ThemeServiceProvider implements ServiceProvider
{
    /**
     * Register services with the application container.
     */
    public function register(Application $app): void
    {
        $app->singleton(
            ThemeSupport::class,
            static fn (): ThemeSupport => new ThemeSupport()
        );

        $app->singleton(
            WidgetManager::class,
            static fn (): WidgetManager => new WidgetManager()
        );

        $app->singleton(
            ImageManager::class,
            static fn (): ImageManager => new ImageManager()
        );

        $app->singleton(
            Hooks::class,
            static fn (): Hooks => new Hooks()
        );
    }

    /**
     * Boot registered services.
     */
    public function boot(Application $app): void
    {
        $app->make(ThemeSupport::class)->boot();

        $app->make(WidgetManager::class)->boot();

        $app->make(ImageManager::class)->boot();

        $app->make(Hooks::class)->boot();
    }
}