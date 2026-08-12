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

        /*
         * This class belongs to the base theme.  get_theme_file_path() is
         * child-theme aware and therefore points at the active child theme
         * when WildTours Base is used as a parent.  That caused the base
         * theme's CSS/JS/PHP files to resolve to the child theme directory.
         */
        $basePath = defined('WILDTOURS_BASE_PATH')
            ? WILDTOURS_BASE_PATH
            : trailingslashit(get_template_directory());

        if ($path === '') {
            return trailingslashit($basePath);
        }

        return trailingslashit($basePath) . $path;
    }

    /**
     * Theme directory URI.
     */
    public static function uri(string $path = ''): string
    {
        $path = ltrim($path, '/');

        /*
         * Always resolve URLs from the parent/base theme.  WordPress's
         * get_theme_file_uri() resolves child-theme files first.
         */
        $baseUri = defined('WILDTOURS_BASE_URL')
            ? WILDTOURS_BASE_URL
            : trailingslashit(get_template_directory_uri());

        if ($path === '') {
            return trailingslashit($baseUri);
        }

        return trailingslashit($baseUri) . $path;
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
     * Asset version string based on the file modification time.
     */
    public static function assetVersion(string $path): string
    {
        $basePath = defined('WILDTOURS_BASE_PATH')
            ? WILDTOURS_BASE_PATH
            : trailingslashit(get_theme_file_path());

        $filePath = $basePath . 'assets/' . ltrim($path, '/');

        if (file_exists($filePath)) {
            return (string) filemtime($filePath);
        }

        return self::version();
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