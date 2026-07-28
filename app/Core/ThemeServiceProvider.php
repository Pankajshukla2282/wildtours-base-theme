<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

use WildTours\Base\Core\Assets;
use WildTours\Base\Core\Editor;
use WildTours\Base\Core\Navigation;
use WildTours\Base\Core\Setup;
use WildTours\Base\Core\Widgets;
use WildTours\Base\Template\TemplateLoader;
use WildTours\Base\Core\Performance;

/**
 * Theme Service Provider.
 */
final class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Theme services.
     *
     * @var array<class-string>
     */
    private const SERVICES = [

        Setup::class,

        Assets::class,

        Widgets::class,

        Editor::class,

        Navigation::class,

        TemplateLoader::class,

        Performance::class,

    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerCore();

        $this->registerThemeServices();
    }

    /**
     * Boot services.
     */
    public function boot(): void
    {
        foreach (self::SERVICES as $service) {

            $this->container
                ->make($service)
                ->register();
        }
    }

    /**
     * Register framework singletons.
     */
    private function registerCore(): void
    {
        $this->container->singleton(
            Hooks::class,
            new Hooks()
        );

        $this->container->singleton(
            Config::class,
            new Config()
        );
    }

    /**
     * Register theme services.
     */
    private function registerThemeServices(): void
    {
        foreach (self::SERVICES as $service) {

            $this->container->bind(

                $service,

                fn (Container $container) => new $service(

                    $container->make(Hooks::class),

                    $container->make(Config::class)

                )

            );
        }
    }
}