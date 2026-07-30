<?php

declare(strict_types=1);

namespace WildTours\Base\Providers;

defined('ABSPATH') || exit;

use WildTours\Base\Core\ServiceProvider;
use WildTours\Base\Template\TemplateLoader;

/**
 * Registers the theme template subsystem.
 */
final class TemplateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->singleton(
            TemplateLoader::class,
            TemplateLoader::class
        );
    }

    /**
     * Boot services.
     */
    public function boot(): void
    {
        $this->make(
            TemplateLoader::class
        )->register();
    }
}