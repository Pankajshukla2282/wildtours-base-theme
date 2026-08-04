<?php

declare(strict_types=1);

namespace WildTours\Base\Theme;

defined('ABSPATH') || exit;

use WildTours\Base\Support\Theme;

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
    }

    /**
     * Load translations.
     */
    private function loadTextDomain(): void
    {
        load_theme_textdomain(
            'wildtours-base',
            Theme::languagesPath()
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

        add_editor_style(
            Theme::assetUri('css/editor.css') . '?ver=' . Theme::assetVersion('css/editor.css')
        );
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
}