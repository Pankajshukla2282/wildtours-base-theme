<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

/**
 * Theme Assets Service.
 *
 * Responsible for registering and loading
 * frontend, editor and admin assets.
 */
final class Assets extends AbstractService
{
    /**
     * Register WordPress hooks.
     */
    public function register(): void
    {
        $this->hooks->action(
            'wp_enqueue_scripts',
            $this,
            'enqueueFrontend'
        );

        $this->hooks->action(
            'enqueue_block_editor_assets',
            $this,
            'enqueueEditor'
        );

        $this->hooks->action(
            'admin_enqueue_scripts',
            $this,
            'enqueueAdmin'
        );
    }

    /**
     * Enqueue frontend assets.
     */
    public function enqueueFrontend(): void
    {
        $this->enqueueFrontendStyles();

        $this->enqueueFrontendScripts();

        $this->localizeScripts();

        $this->enqueueCommentReplyScript();
    }

    /**
     * Enqueue frontend styles.
     */
    private function enqueueFrontendStyles(): void
    {
        wp_enqueue_style(
            'wildtours-base-style',
            get_stylesheet_uri(),
            [],
            WTBT_VERSION
        );

        wp_enqueue_style(
            'wildtours-base-frontend',
            $this->asset('css.frontend'),
            [
                'wildtours-base-style',
            ],
            WTBT_VERSION
        );
    }

    /**
     * Enqueue frontend scripts.
     */
    private function enqueueFrontendScripts(): void
    {
        wp_enqueue_script(
            'wildtours-base-navigation',
            $this->asset('js.navigation'),
            [],
            WTBT_VERSION,
            true
        );

        wp_enqueue_script(
            'wildtours-base-theme',
            $this->asset('js.theme'),
            [
                'wildtours-base-navigation',
            ],
            WTBT_VERSION,
            true
        );
    }

    /**
     * Enqueue editor assets.
     */
    public function enqueueEditor(): void
    {
        wp_enqueue_style(
            'wildtours-base-editor',
            $this->asset('css.editor'),
            [],
            WTBT_VERSION
        );

        wp_enqueue_script(
            'wildtours-base-editor',
            $this->asset('css.editor'),
            [
                'wp-blocks',
                'wp-dom-ready',
                'wp-edit-post',
            ],
            WTBT_VERSION,
            true
        );
    }

    /**
     * Enqueue admin assets.
     */
    public function enqueueAdmin(): void
    {
        wp_enqueue_style(
            'wildtours-base-admin',
            $this->asset('css.admin'),
            [],
            WTBT_VERSION
        );

        wp_enqueue_script(
            'wildtours-base-admin',
            $this->asset('js.admin'),
            [
                'jquery',
            ],
            WTBT_VERSION,
            true
        );
    }

    /**
     * Localize frontend scripts.
     */
    private function localizeScripts(): void
    {
        wp_localize_script(
            'wildtours-base-theme',
            'WTBT',
            [
                'ajaxUrl'    => admin_url('admin-ajax.php'),
                'homeUrl'    => home_url('/'),
                'themeUrl'   => WTBT_URI,
                'nonce'      => wp_create_nonce(
                    $this->config->get('security.nonce_action')
                ),
                'loggedIn'   => is_user_logged_in(),
                'language'   => get_locale(),
                'restUrl'    => esc_url_raw(rest_url()),
            ]
        );
    }

    /**
     * Load comment-reply script when required.
     */
    private function enqueueCommentReplyScript(): void
    {
        if (
            is_singular() &&
            comments_open() &&
            get_option('thread_comments')
        ) {
            wp_enqueue_script(
                'comment-reply'
            );
        }
    }

    /**
     * Get CSS asset URL.
     */
    private function css(string $asset): string
    {
        return WTBT_URI . $this->config->get(
            "assets.css.{$asset}"
        );
    }

    /**
     * Get JavaScript asset URL.
     */
    private function js(string $asset): string
    {
        return WTBT_URI . $this->config->get(
            "assets.js.{$asset}"
        );
    }

    /**
     * Resolve an asset URL.
     */
    private function asset(string $key): string
    {
        $path = $this->config->get("assets.{$key}");

        if (! is_string($path) || $path === '') {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return WTBT_URI . $path;
    }
}