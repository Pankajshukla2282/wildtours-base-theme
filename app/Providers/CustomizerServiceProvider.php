<?php

declare(strict_types=1);

namespace WildTours\Base\Providers;

defined('ABSPATH') || exit;

use WildTours\Base\Core\ServiceProvider;
use WildTours\Base\Customizer\CustomizerManager;

/**
 * Registers the theme customizer subsystem.
 */
final class CustomizerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->singleton(
            CustomizerManager::class,
            CustomizerManager::class
        );
    }

    /**
     * Boot services.
     */
    public function boot(): void
    {
        $this->make(
            CustomizerManager::class
        )->register();
    }
}