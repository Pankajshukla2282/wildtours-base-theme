<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

/**
 * Framework configuration repository.
 *
 * Stores immutable framework configuration.
 * Child themes and plugins can override values
 * using the `wtbt_config` filter.
 */
final class Config
{
    /**
     * Framework configuration.
     *
     * @var array<string, mixed>
     */
    private readonly array $config;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->config = apply_filters(
            'wtbt_config',
            $this->defaults()
        );
    }

    /**
     * Get a configuration value.
     *
     * Supports dot notation.
     *
     * Example:
     *
     * theme.version
     * menus.primary
     * image_sizes.banner.width
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(
        string $key,
        mixed $default = null
    ): mixed {

        $segments = explode('.', $key);

        $value = $this->config;

        foreach ($segments as $segment) {

            if (
                ! is_array($value) ||
                ! array_key_exists($segment, $value)
            ) {
                return $default;
            }

            $value = $value[$segment];
        }

        return $value;
    }

    /**
     * Determine whether a configuration value exists.
     */
    public function has(string $key): bool
    {
        $segments = explode('.', $key);

        $value = $this->config;

        foreach ($segments as $segment) {

            if (
                ! is_array($value) ||
                ! array_key_exists($segment, $value)
            ) {
                return false;
            }

            $value = $value[$segment];
        }

        return true;
    }

    /**
     * Return the complete configuration.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $this->config;
    }

    /**
     * Default framework configuration.
     *
     * @return array<string, mixed>
     */
    private function defaults(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Theme
            |--------------------------------------------------------------------------
            */

            'theme' => [

                'name' => 'WildTours Base Theme',

                'text_domain' => 'wildtours-base-theme',

                'version' => WTBT_VERSION,

                'uri' => WTBT_URI,

                'path' => WTBT_PATH,

            ],

            /*
            |--------------------------------------------------------------------------
            | Navigation Menus
            |--------------------------------------------------------------------------
            */

            'menus' => [

                'primary' => 'Primary Menu',

                'secondary' => 'Secondary Menu',

                'mobile' => 'Mobile Menu',

                'footer' => 'Footer Menu',

                'social' => 'Social Menu',

            ],

            /*
            |--------------------------------------------------------------------------
            | Image Sizes
            |--------------------------------------------------------------------------
            */

            'image_sizes' => [

                'card' => [

                    'width' => 480,

                    'height' => 320,

                    'crop' => true,

                ],

                'banner' => [

                    'width' => 1920,

                    'height' => 720,

                    'crop' => true,

                ],

                'square' => [

                    'width' => 800,

                    'height' => 800,

                    'crop' => true,

                ],

            ],

            /*
            |--------------------------------------------------------------------------
            | Asset Paths
            |--------------------------------------------------------------------------
            */

            'assets' => [

                'css' => [

                    'frontend' => '/assets/css/frontend.css',

                    'editor' => '/assets/css/editor.css',

                    'admin' => '/assets/css/admin.css',

                ],

                'js' => [

                    'navigation' => '/assets/js/navigation.js',

                    'theme' => '/assets/js/theme.js',

                    'editor' => '/assets/js/editor.js',

                    'admin' => '/assets/js/admin.js',

                ],

            ],

            /*
            |--------------------------------------------------------------------------
            | Security
            |--------------------------------------------------------------------------
            */

            'security' => [

                'nonce_action' => 'wtbt_nonce',

                'nonce_name' => '_wtbt_nonce',

            ],

            /*
            |--------------------------------------------------------------------------
            | Features
            |--------------------------------------------------------------------------
            */

            'features' => [

                'woocommerce' => true,

                'getwid' => true,

                'rtl' => true,

                'schema' => true,

                'breadcrumbs' => true,

                'lazy_loading' => true,

            ],

            /*
            |--------------------------------------------------------------------------
            | Sidebars
            |--------------------------------------------------------------------------
            */

            'sidebars' => [

                'sidebar' => [

                    'name' => 'Primary Sidebar',

                    'description' => 'Main sidebar displayed on posts and pages.',

                    'before_widget' => '<section id="%1$s" class="widget %2$s">',

                    'after_widget' => '</section>',

                    'before_title' => '<h2 class="widget-title">',

                    'after_title' => '</h2>',

                ],

                'footer-1' => [

                    'name' => 'Footer Column 1',

                    'description' => 'Footer widget area 1.',

                    'before_widget' => '<section id="%1$s" class="widget %2$s">',

                    'after_widget' => '</section>',

                    'before_title' => '<h2 class="widget-title">',

                    'after_title' => '</h2>',

                ],

                'footer-2' => [

                    'name' => 'Footer Column 2',

                    'description' => 'Footer widget area 2.',

                    'before_widget' => '<section id="%1$s" class="widget %2$s">',

                    'after_widget' => '</section>',

                    'before_title' => '<h2 class="widget-title">',

                    'after_title' => '</h2>',

                ],

                'footer-3' => [

                    'name' => 'Footer Column 3',

                    'description' => 'Footer widget area 3.',

                    'before_widget' => '<section id="%1$s" class="widget %2$s">',

                    'after_widget' => '</section>',

                    'before_title' => '<h2 class="widget-title">',

                    'after_title' => '</h2>',

                ],

                'footer-4' => [

                    'name' => 'Footer Column 4',

                    'description' => 'Footer widget area 4.',

                    'before_widget' => '<section id="%1$s" class="widget %2$s">',

                    'after_widget' => '</section>',

                    'before_title' => '<h2 class="widget-title">',

                    'after_title' => '</h2>',

                ],

            ],

            'editor' => [

                'colors' => [

                    [
                        'name'  => 'Primary',
                        'slug'  => 'primary',
                        'color' => '#0B6E4F',
                    ],

                    [
                        'name'  => 'Secondary',
                        'slug'  => 'secondary',
                        'color' => '#F4A261',
                    ],

                    [
                        'name'  => 'Accent',
                        'slug'  => 'accent',
                        'color' => '#2A9D8F',
                    ],

                    [
                        'name'  => 'Dark',
                        'slug'  => 'dark',
                        'color' => '#264653',
                    ],

                    [
                        'name'  => 'Light',
                        'slug'  => 'light',
                        'color' => '#F8F9FA',
                    ],

                ],
                'font_sizes' => [

                    [
                        'name' => 'Small',
                        'slug' => 'small',
                        'size' => 14,
                    ],

                    [
                        'name' => 'Normal',
                        'slug' => 'normal',
                        'size' => 16,
                    ],

                    [
                        'name' => 'Medium',
                        'slug' => 'medium',
                        'size' => 20,
                    ],

                    [
                        'name' => 'Large',
                        'slug' => 'large',
                        'size' => 32,
                    ],

                    [
                        'name' => 'Extra Large',
                        'slug' => 'x-large',
                        'size' => 48,
                    ],

                ],
            'gradients' => [

                [
                    'name' => 'Primary',
                    'slug' => 'primary-gradient',
                    'gradient' =>
                        'linear-gradient(135deg,#0B6E4F,#2A9D8F)',
                ],

                [
                    'name' => 'Sunset',
                    'slug' => 'sunset',
                    'gradient' =>
                        'linear-gradient(135deg,#F4A261,#E76F51)',
                ],

            ],
            'performance' => [

                'remove_emojis' => true,

                'remove_embeds' => true,

                'remove_dashicons' => true,

                'lazy_loading' => true,

                'async' => [

                ],

                'defer' => [

                    'wildtours-base-theme',

                    'wildtours-base-navigation',

                ],

                'preconnect' => [

                    [
                        'href' => 'https://fonts.gstatic.com',
                        'crossorigin' => 'anonymous',
                    ],

                ],

                'dns_prefetch' => [

                ],

                'preload' => [

                ],

            ],
        ],    
        ];
    }
    
    /**
     * Get a configuration section.
     *
     * @return array<string, mixed>
     */
    public function section(string $key): array
    {
        $value = $this->get($key, []);

        return is_array($value)
            ? $value
            : [];
    }
 
}
