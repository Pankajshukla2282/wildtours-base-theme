<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

final class Application 
{
    private static ?Container $container = null;

    /**
     * Bootstrap the application.
     */
    public static function boot(): void
    {
        self::$container = new Container();

        $provider = new ThemeServiceProvider(
            self::$container
        );

        $provider->register();

        $provider->boot();
    }

    /**
     * Return the container.
     */
    public static function container(): Container
    {
        return self::$container;
    }
}