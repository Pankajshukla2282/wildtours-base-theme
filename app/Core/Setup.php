<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

/**
 * Theme Setup Service.
 *
 * Responsible for initializing all WordPress
 * theme features.
 */
final class Setup extends AbstractService
{
    /**
     * Register WordPress hooks.
     */
    public function register(): void
    {
        $this->hooks->action(
            'after_setup_theme',
            $this,
            'boot'
        );
    }

    /**
     * Boot theme.
     */
    public function boot(): void
    {
        $this->loadTextDomain();

        $this->registerThemeSupports();

        $this->registerMenus();

        $this->registerImageSizes();

        $this->registerEditorStyles();
    }

    /**
     * Load theme translations.
     */
    private function loadTextDomain(): void
    {
        load_theme_textdomain(
            $this->config->get('theme.text_domain'),
            WTBT_PATH . '/languages'
        );
    }

    /**
     * Register all theme supports.
     */
    private function registerThemeSupports(): void
    {
        $supports = [

            'title-tag',

            'automatic-feed-links',

            'post-thumbnails',

            'responsive-embeds',

            'align-wide',

            'wp-block-styles',

            'editor-styles',

            'appearance-tools',

            'custom-spacing',

            'custom-line-height',

            'custom-units',

        ];

        foreach ($supports as $support) {
            add_theme_support($support);
        }

        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            ]
        );

        add_theme_support(
            'custom-logo',
            [
                'height'       => 120,
                'width'        => 300,
                'flex-height'  => true,
                'flex-width'   => true,
            ]
        );

        add_theme_support(
            'custom-background'
        );

        add_theme_support(
            'custom-header'
        );

        if ($this->config->get('features.woocommerce')) {

            add_theme_support('woocommerce');

            add_theme_support('wc-product-gallery-zoom');

            add_theme_support('wc-product-gallery-lightbox');

            add_theme_support('wc-product-gallery-slider');
        }
    }

    /**
     * Register navigation menus.
     */
    private function registerMenus(): void
    {
        $menus = [];

        foreach (
            $this->config->section('menus')
            as $location => $label
        ) {

            $menus[$location] = __(
                $label,
                $this->config->get('theme.text_domain')
            );
        }

        register_nav_menus($menus);
    }

    /**
     * Register custom image sizes.
     */
    private function registerImageSizes(): void
    {
        foreach (
            $this->config->section('image_sizes')
            as $name => $size
        ) {

            add_image_size(
                $name,
                (int) $size['width'],
                (int) $size['height'],
                (bool) $size['crop']
            );
        }
    }

    /**
     * Register editor stylesheet.
     */
    private function registerEditorStyles(): void
    {
        add_editor_style(
            'assets/css/editor.css'
        );
    }
}