<?php

declare(strict_types=1);

namespace WildTours\Base\Template;

use WildTours\Base\Core\AbstractService;

final class TemplateLoader extends AbstractService
{
    /**
     * Register hooks.
     */
    public function register(): void
    {
        // Reserved for future template hooks.
    }

    /**
     * Render a template.
     *
     * @param string               $slug
     * @param array<string, mixed> $args
     */
    public function render(
        string $slug,
        array $args = []
    ): void {

        $template = $this->locate($slug);

        if ($template === '') {
            return;
        }

        /**
         * Fires before rendering.
         */
        do_action(
            'wtbt_before_render_template',
            $slug,
            $args,
            $template
        );

        if ($args !== []) {
            extract($args, EXTR_SKIP);
        }

        require $template;

        /**
         * Fires after rendering.
         */
        do_action(
            'wtbt_after_render_template',
            $slug,
            $args,
            $template
        );
    }

    /**
     * Locate template.
     */
    public function locate(
        string $slug
    ): string {

        $template = locate_template(
            [
                "templates/{$slug}.php",
            ],
            false,
            false
        );

        if ($template !== '') {
            return $template;
        }

        $parent = WTBT_PATH .
            "/templates/{$slug}.php";

        if (file_exists($parent)) {
            return $parent;
        }

        return '';
    }

    /**
     * Determine whether template exists.
     */
    public function exists(
        string $slug
    ): bool {

        return $this->locate($slug) !== '';
    }
}