<?php

declare(strict_types=1);

namespace WildTours\Base\Support;

defined('ABSPATH') || exit;

/**
 * Theme helper.
 *
 * Provides strongly typed access to common theme paths and URLs.
 */
final class Theme
{
    /**
     * Theme version.
     */
    public static function version(): string
    {
        static $version = null;

        if ($version === null) {
            $version = wp_get_theme()->get('Version');
        }

        return $version;
    }

    /**
     * Theme directory path.
     */
    public static function path(string $path = ''): string
    {
        return trailingslashit(get_template_directory()) . ltrim($path, '/');
    }

    /**
     * Theme directory URI.
     */
    public static function uri(string $path = ''): string
    {
        return trailingslashit(get_template_directory_uri()) . ltrim($path, '/');
    }

    /**
     * Assets path.
     */
    public static function assetPath(string $path = ''): string
    {
        return self::path('assets/' . ltrim($path, '/'));
    }

    /**
     * Assets URI.
     */
    public static function assetUri(string $path = ''): string
    {
        return self::uri('assets/' . ltrim($path, '/'));
    }

    /**
     * App path.
     */
    public static function appPath(string $path = ''): string
    {
        return self::path('app/' . ltrim($path, '/'));
    }

    /**
     * Languages path.
     */
    public static function languagesPath(): string
    {
        return self::path('languages');
    }

    /**
     * Template path.
     */
    public static function templatePath(string $path = ''): string
    {
        return self::path('templates/' . ltrim($path, '/'));
    }
}