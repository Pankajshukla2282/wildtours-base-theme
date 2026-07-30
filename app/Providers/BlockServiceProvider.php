<?php

declare(strict_types=1);

namespace WildTours\Base\Providers;

defined('ABSPATH') || exit;

use WildTours\Base\Blocks\BlockManager;
use WildTours\Base\Core\ServiceProvider;

/**
 * Bootstrap Gutenberg block features.
 */
final class BlockServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->singleton(
            BlockManager::class,
            BlockManager::class
        );
    }

    /**
     * Boot services.
     */
    public function boot(): void
    {
        $this->make(BlockManager::class)
            ->register();
    }
}