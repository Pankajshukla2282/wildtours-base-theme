<?php

declare(strict_types=1);

namespace WildTours\Base\Providers;

defined('ABSPATH') || exit;

use WildTours\Base\Assets\AssetManager;
use WildTours\Base\Core\ServiceProvider;

/**
 * Registers and boots the theme asset manager.
 */
final class AssetsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->singleton(
            AssetManager::class,
            AssetManager::class
        );
    }

    /**
     * Boot services.
     */
    public function boot(): void
    {
        $this->make(AssetManager::class)
            ->register();
    }
}