<?php

declare(strict_types=1);

use WildTours\Base\Template\View;

defined('ABSPATH') || exit;

if (!function_exists('wt_view')) {
    /**
     * Render a template.
     *
     * @param string $template
     * @param array<string,mixed> $data
     */
    function wt_view(
        string $template,
        array $data = []
    ): void {
        View::render($template, $data);
    }
}

if (!function_exists('wt_classes')) {
    /**
     * Return CSS classes.
     *
     * @param array<int,string> $classes
     */
    function wt_classes(array $classes): string
    {
        return View::classes($classes);
    }
}

if (!function_exists('wt_attr')) {
    /**
     * Return HTML attributes.
     *
     * @param array<string,mixed> $attributes
     */
    function wt_attr(array $attributes = []): string
    {
        return View::attributes($attributes);
    }
}