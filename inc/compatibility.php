<?php

/**
 * Compatibility Layer
 *
 * Provides backward compatibility and optional integrations with
 * WordPress core and third-party plugins.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/*
|--------------------------------------------------------------------------
| WordPress Compatibility
|--------------------------------------------------------------------------
|
| Place compatibility code for older WordPress versions here.
| Example:
|
| if (version_compare($GLOBALS['wp_version'], '6.8', '<')) {
|     require __DIR__ . '/compat/wp-6.7.php';
| }
|
*/

/*
|--------------------------------------------------------------------------
| Optional Plugin Integrations
|--------------------------------------------------------------------------
|
| Keep integrations lightweight and optional.
| Never assume a plugin is active.
|
*/

/**
 * Yoast SEO.
 */
if (defined('WPSEO_VERSION')) {
    /**
     * Yoast-specific compatibility hooks may be added here.
     */
}

/**
 * Rank Math.
 */
if (defined('RANK_MATH_VERSION')) {
    /**
     * Rank Math compatibility hooks.
     */
}

/**
 * WooCommerce.
 */
if (class_exists('WooCommerce')) {
    /**
     * WooCommerce compatibility hooks.
     */
}

/**
 * Getwid.
 */
if (defined('GETWID_VERSION')) {
    /**
     * Getwid compatibility hooks.
     */
}

/**
 * Elementor.
 */
if (defined('ELEMENTOR_VERSION')) {
    /**
     * Elementor compatibility hooks.
     */
}

/*
|--------------------------------------------------------------------------
| Compatibility Actions
|--------------------------------------------------------------------------
|
| Child themes and plugins can hook here to register additional
| compatibility logic without modifying this file.
|
*/

do_action('wildtours/base/compatibility_loaded');