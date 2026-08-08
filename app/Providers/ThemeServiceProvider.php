<?php

declare(strict_types=1);

namespace WildTours\Base\Providers;

use WildTours\Base\Core\ServiceProvider;
use WildTours\Base\Theme\Hooks;
use WildTours\Base\Theme\ImageManager;
use WildTours\Base\Theme\Schema;
use WildTours\Base\Theme\ThemeSupport;
use WildTours\Base\Theme\WidgetManager;

defined('ABSPATH') || exit;

/**
 * Registers and boots theme services.
 *
 * @package WildTours\Base
 */
final class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services with the application container.
     */
    public function register(): void
    {
        $this->singleton(
            ThemeSupport::class,
            ThemeSupport::class
        );

        $this->singleton(
            WidgetManager::class,
            WidgetManager::class
        );

        $this->singleton(
            ImageManager::class,
            ImageManager::class
        );

        $this->singleton(
            Hooks::class,
            Hooks::class
        );

        $this->singleton(
            Schema::class,
            Schema::class
        );
    }

    /**
     * Boot registered services.
     */
    public function boot(): void
    {
        $this->make(ThemeSupport::class)->boot();

        $this->make(WidgetManager::class)->boot();

        $this->make(ImageManager::class)->boot();

        $this->make(Hooks::class)->boot();

        $this->make(Schema::class)->boot();
    }
}