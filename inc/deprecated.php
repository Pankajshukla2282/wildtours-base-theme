<?php

/**
 * Deprecated Functions
 *
 * Backward compatibility layer for deprecated theme functions.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * -------------------------------------------------------------------------
 * Deprecation Version
 * -------------------------------------------------------------------------
 */

if (!defined('WILDTOURS_BASE_DEPRECATION_VERSION')) {
    define('WILDTOURS_BASE_DEPRECATION_VERSION', '1.0.0');
}

/**
 * -------------------------------------------------------------------------
 * Deprecated Template Functions
 * -------------------------------------------------------------------------
 */

if (!function_exists('wildtours_post_meta')) {

    /**
     * @deprecated 1.0.0 Use wildtours_entry_meta().
     */
    function wildtours_post_meta(): void
    {
        _deprecated_function(
            __FUNCTION__,
            WILDTOURS_BASE_DEPRECATION_VERSION,
            'wildtours_entry_meta'
        );

        if (function_exists('wildtours_entry_meta')) {
            wildtours_entry_meta();
        }
    }
}

if (!function_exists('wildtours_post_footer')) {

    /**
     * @deprecated 1.0.0 Use wildtours_entry_footer().
     */
    function wildtours_post_footer(): void
    {
        _deprecated_function(
            __FUNCTION__,
            WILDTOURS_BASE_DEPRECATION_VERSION,
            'wildtours_entry_footer'
        );

        if (function_exists('wildtours_entry_footer')) {
            wildtours_entry_footer();
        }
    }
}

if (!function_exists('wildtours_featured_image')) {

    /**
     * @deprecated 1.0.0 Use wildtours_post_thumbnail().
     */
    function wildtours_featured_image(
        string $size = 'post-thumbnail'
    ): void {

        _deprecated_function(
            __FUNCTION__,
            WILDTOURS_BASE_DEPRECATION_VERSION,
            'wildtours_post_thumbnail'
        );

        if (function_exists('wildtours_post_thumbnail')) {
            wildtours_post_thumbnail($size);
        }
    }
}

/**
 * -------------------------------------------------------------------------
 * Deprecated Filters
 * -------------------------------------------------------------------------
 */

/**
 * Maps legacy filter names to new filters.
 */
add_filter(
    'wildtours/base/excerpt_length',
    static function (int $length): int {

        return (int) apply_filters(
            'wildtours_excerpt_length',
            $length
        );

    }
);

add_filter(
    'wildtours/base/excerpt_more',
    static function (string $more): string {

        return (string) apply_filters(
            'wildtours_excerpt_more',
            $more
        );

    }
);

/**
 * -------------------------------------------------------------------------
 * Deprecated Actions
 * -------------------------------------------------------------------------
 */

/**
 * Bridge legacy action names.
 */
add_action(
    'wildtours/base/entry_meta',
    static function (): void {

        do_action(
            'wildtours_entry_meta'
        );

    }
);

add_action(
    'wildtours/base/entry_footer',
    static function (): void {

        do_action(
            'wildtours_entry_footer'
        );

    }
);

/**
 * -------------------------------------------------------------------------
 * Deprecation Hook
 * -------------------------------------------------------------------------
 */

do_action(
    'wildtours/base/deprecated_loaded'
);