<?php

declare(strict_types=1);

namespace WildTours\Base\Assets;

defined('ABSPATH') || exit;

use WildTours\Base\Support\Theme;

/**
 * Registers and enqueues theme assets.
 */
final class AssetManager
{
    /**
     * Register WordPress hooks.
     */
    public function register(): void
    {
        add_action(
            'wp_enqueue_scripts',
            [$this, 'enqueueFrontend']
        );
        
        add_action(
            'wp_enqueue_scripts',
            [$this, 'enqueueNavigation']
        );

        add_action(
            'enqueue_block_editor_assets',
            [$this, 'enqueueEditor']
        );

        add_action(
            'admin_enqueue_scripts',
            [$this, 'enqueueAdmin']
        );

        add_action(
            'login_enqueue_scripts',
            [$this, 'enqueueLogin']
        );
    }

    /**
     * Enqueue frontend assets.
     */
    public function enqueueFrontend(): void
    {
        wp_enqueue_style(
            'wildtours-base',
            Theme::assetUri('css/frontend.css'),
            [],
            Theme::assetVersion('css/frontend.css')
        );

        if (is_rtl()) {
            wp_enqueue_style(
                'wildtours-base-rtl',
                Theme::assetUri('css/rtl.css'),
                ['wildtours-base'],
                Theme::assetVersion('css/rtl.css')
            );
        }

        wp_enqueue_script(
            'wildtours-base',
            Theme::assetUri('js/frontend.js'),
            [],
            Theme::assetVersion('js/frontend.js'),
            true
        );
    }

    /**
     * Enqueue editor assets.
     */
    public function enqueueEditor(): void
    {
        wp_enqueue_script(
            'wildtours-base-editor',
            Theme::assetUri('js/editor.js'),
            ['wp-blocks', 'wp-element', 'wp-edit-post'],
            Theme::assetVersion('js/editor.js'),
            true
        );
    }

    /**
     * Enqueue admin assets.
     */
    public function enqueueAdmin(): void
    {
        if (!is_admin()) {
            return;
        }

        wp_enqueue_style(
            'wildtours-base-admin',
            Theme::assetUri('css/admin.css'),
            [],
            Theme::assetVersion('css/admin.css')
        );
    }

    /**
     * Enqueue login assets.
     */
    public function enqueueLogin(): void
    {
        wp_enqueue_style(
            'wildtours-base-login',
            Theme::assetUri('css/login.css'),
            [],
            Theme::assetVersion('css/login.css')
        );
    }

    /**
     * Enqueue Navigation assets.
     */
    public function enqueueNavigation(): void
    {
        wp_enqueue_script(
            'wildtours-navigation',
            Theme::assetUri('js/navigation.js'),
            [],
            Theme::assetVersion('js/navigation.js'),
            true
        );
    }
    

}