<?php

declare(strict_types=1);

namespace WildTours\Base\Template;

defined('ABSPATH') || exit;

/**
 * Lightweight template loader for the theme.
 */
final class TemplateLoader
{
    /**
     * Register template-related hooks.
     */
    public function register(): void
    {
        // Reserved for future template hooks.
    }

    /**
     * Render a template with scoped data.
     *
     * @param array<string,mixed> $data
     */
    public function render(string $template, array $data = []): void
    {
        $path = $this->locate($template);

        if ($path === null) {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                trigger_error(
                    sprintf('Template not found: %s', $template),
                    E_USER_WARNING
                );
            }

            return;
        }

        if ($data !== []) {
            extract($data, EXTR_SKIP);
        }

        include $path;
    }

    /**
     * Locate a template path within the active theme.
     */
    public function locate(string $template): ?string
    {
        $template = trim($template);

        if ($template === '') {
            return null;
        }

        $clean = ltrim($template, '/');

        if (!str_ends_with($clean, '.php')) {
            $clean .= '.php';
        }

        $candidates = [
            $clean,
            'templates/' . $clean,
            'template-parts/' . $clean,
        ];

        $path = locate_template($candidates, false, false);

        return $path !== '' ? $path : null;
    }
}
