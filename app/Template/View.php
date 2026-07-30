<?php

declare(strict_types=1);

namespace WildTours\Base\Template;

defined('ABSPATH') || exit;

/**
 * Theme view helper.
 *
 * Provides reusable rendering helpers while preserving
 * native WordPress template loading.
 */
final class View
{
    /**
     * Render a template.
     *
     * @param string               $template Template name without extension.
     * @param array<string,mixed>  $data     Variables available to the template.
     */
    public static function render(
        string $template,
        array $data = []
    ): void {
        $loader = new TemplateLoader();

        $loader->render($template, $data);
    }

    /**
     * Escape HTML.
     */
    public static function e(?string $value): string
    {
        return esc_html($value ?? '');
    }

    /**
     * Escape attribute.
     */
    public static function attr(?string $value): string
    {
        return esc_attr($value ?? '');
    }

    /**
     * Escape URL.
     */
    public static function url(?string $url): string
    {
        return esc_url($url ?? '');
    }

    /**
     * Escape textarea.
     */
    public static function textarea(?string $value): string
    {
        return esc_textarea($value ?? '');
    }

    /**
     * Output a checked attribute.
     */
    public static function checked(
        mixed $checked,
        mixed $current = true
    ): void {
        checked($checked, $current);
    }

    /**
     * Output a selected attribute.
     */
    public static function selected(
        mixed $selected,
        mixed $current = true
    ): void {
        selected($selected, $current);
    }

    /**
     * Build HTML attributes.
     *
     * @param array<string,mixed> $attributes
     */
    public static function attributes(array $attributes = []): string
    {
        $output = [];

        foreach ($attributes as $name => $value) {

            if ($value === null || $value === false) {
                continue;
            }

            if ($value === true) {
                $output[] = esc_attr($name);
                continue;
            }

            if (is_array($value)) {
                $value = implode(' ', array_filter($value));
            }

            $output[] = sprintf(
                '%s="%s"',
                esc_attr((string) $name),
                esc_attr((string) $value)
            );
        }

        return implode(' ', $output);
    }

    /**
     * Return CSS classes.
     *
     * @param array<int,string> $classes
     */
    public static function classes(array $classes): string
    {
        return implode(
            ' ',
            array_unique(
                array_filter($classes)
            )
        );
    }

    /**
     * Echo classes.
     *
     * @param array<int,string> $classes
     */
    public static function class(array $classes): void
    {
        echo esc_attr(
            self::classes($classes)
        );
    }
}