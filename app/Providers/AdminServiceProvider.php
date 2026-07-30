<?php

declare(strict_types=1);

namespace WildTours\Base\Providers;

defined('ABSPATH') || exit;

use WildTours\Base\Admin\AdminManager;
use WildTours\Base\Core\ServiceProvider;

/**
 * Registers the theme admin subsystem.
 */
final class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->singleton(
            AdminManager::class,
            AdminManager::class
        );
    }

    /**
     * Boot services.
     */
    public function boot(): void
    {
        $this->make(AdminManager::class)
            ->register();
    }
}