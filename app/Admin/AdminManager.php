<?php

declare(strict_types=1);

namespace WildTours\Base\Admin;

defined('ABSPATH') || exit;

/**
 * Theme admin functionality.
 */
final class AdminManager
{
    /**
     * Register admin hooks.
     */
    public function register(): void
    {
        if (!is_admin()) {
            return;
        }

        add_action(
            'admin_init',
            [$this, 'init']
        );

        add_action(
            'admin_notices',
            [$this, 'adminNotices']
        );
    }

    /**
     * Initialize admin functionality.
     */
    public function init(): void
    {
        // Future:
        // - Theme migration routines
        // - Upgrade notices
        // - Admin settings
        // - Welcome screen
    }

    /**
     * Display admin notices.
     */
    public function adminNotices(): void
    {
        /**
         * Intentionally left empty.
         *
         * Child themes or future versions may hook
         * into this manager to display upgrade or
         * compatibility notices.
         */
    }
}