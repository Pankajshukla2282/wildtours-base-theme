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
        $path = ltrim($path, '/');

        if ($path === '') {
            return trailingslashit(get_theme_file_path());
        }

        return trailingslashit(get_theme_file_path($path));
    }

    /**
     * Theme directory URI.
     */
    public static function uri(string $path = ''): string
    {
        $path = ltrim($path, '/');

        if ($path === '') {
            return trailingslashit(get_theme_file_uri());
        }

        return trailingslashit(get_theme_file_uri($path));
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