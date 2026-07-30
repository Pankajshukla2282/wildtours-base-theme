<?php

declare(strict_types=1);

namespace WildTours\Base\Theme;

defined('ABSPATH') || exit;

/**
 * Registers classic WordPress theme features.
 *
 * @package WildTours\Base
 */
final class ThemeSupport
{
    /**
     * Boot theme support.
     */
    public function boot(): void
    {
        add_action('after_setup_theme', [$this, 'register']);
    }

    /**
     * Register all theme features.
     */
    public function register(): void
    {
        $this->loadTextDomain();
        $this->registerSupports();
        $this->registerMenus();
        $this->registerImageSizes();
    }

    /**
     * Load translations.
     */
    private function loadTextDomain(): void
    {
        load_theme_textdomain(
            'wildtours-base',
            get_template_directory() . '/languages'
        );
    }

    /**
     * Register WordPress theme supports.
     */
    private function registerSupports(): void
    {
        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        add_theme_support('automatic-feed-links');

        add_theme_support('responsive-embeds');

        add_theme_support('wp-block-styles');

        add_theme_support('align-wide');

        add_theme_support('custom-line-height');

        add_theme_support('custom-spacing');

        add_theme_support('custom-units');

        add_theme_support('appearance-tools');

        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            ]
        );

        add_theme_support(
            'custom-logo',
            [
                'height'      => 120,
                'width'       => 320,
                'flex-height' => true,
                'flex-width'  => true,
            ]
        );

        add_theme_support(
            'custom-background',
            [
                'default-color' => 'ffffff',
            ]
        );

        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support('editor-styles');

        add_editor_style('assets/css/editor.css');
    }

    /**
     * Register navigation menus.
     */
    private function registerMenus(): void
    {
        register_nav_menus([
            'primary'   => esc_html__('Primary Navigation', 'wildtours-base'),
            'secondary' => esc_html__('Secondary Navigation', 'wildtours-base'),
            'footer'    => esc_html__('Footer Navigation', 'wildtours-base'),
            'social'    => esc_html__('Social Links', 'wildtours-base'),
        ]);
    }

    /**
     * Register image sizes.
     */
    private function registerImageSizes(): void
    {
        add_image_size(
            'wildtours-featured',
            1600,
            900,
            true
        );

        add_image_size(
            'wildtours-card',
            768,
            512,
            true
        );

        add_image_size(
            'wildtours-thumbnail',
            480,
            320,
            true
        );
    }
}