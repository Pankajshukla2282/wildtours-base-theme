<?php

declare(strict_types=1);

namespace WildTours\Base\Core;


final class Performance extends AbstractService
{
    public function register(): void
    {
        $this->hooks->filter(
            'script_loader_tag',
            $this,
            'filterScriptTag',
            10,
            3
        );

        $this->hooks->filter(
            'style_loader_tag',
            $this,
            'filterStyleTag',
            10,
            4
        );

        $this->hooks->filter(
            'wp_resource_hints',
            $this,
            'resourceHints',
            10,
            2
        );

        $this->hooks->action(
            'wp_enqueue_scripts',
            $this,
            'cleanupAssets',
            100
        );
    }    

    public function resourceHints(
            array $urls,
            string $relation
        ): array {

            if ($relation === 'preconnect') {

                $urls[] = [
                    'href' => 'https://fonts.gstatic.com',
                    'crossorigin' => 'anonymous',
                ];
            }

            return $urls;
        }    

        public function filterScriptTag(
        string $tag,
        string $handle,
        string $src
    ): string {

        $defer = [

            'wildtours-base-theme',

            'wildtours-base-navigation',

        ];

        if (
            in_array(
                $handle,
                $defer,
                true
            )
        ) {

            return str_replace(
                '<script ',
                '<script defer ',
                $tag
            );
        }

        return $tag;
    }

    /**
     * Filter stylesheet tag.
     *
     * Currently returns the tag unchanged. This method exists because
     * register() attaches it to the style_loader_tag filter.
     */
    public function filterStyleTag(
        string $html,
        string $handle,
        string $href,
        string $media
    ): string {
        return $html;
    }
    /**
     * Cleanup frontend assets.
     *
     * Placeholder implementation. The original project appears to have
     * registered this callback but the method was removed during a refactor.
     * Returning without changes preserves default WordPress behaviour.
     *
     * @return void
     */
    public function cleanupAssets(): void
    {
        // Intentionally left blank.
    }
}