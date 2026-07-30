<?php

declare(strict_types=1);

namespace WildTours\Base\Theme;

defined('ABSPATH') || exit;

/**
 * Registers image sizes and image-related settings.
 *
 * @package WildTours\Base
 */
final class ImageManager
{
    /**
     * Boot image manager.
     */
    public function boot(): void
    {
        add_action(
            'after_setup_theme',
            [$this, 'register']
        );
    }

    /**
     * Register image configuration.
     */
    public function register(): void
    {
        $this->registerImageSizes();

        add_filter(
            'image_size_names_choose',
            [$this, 'registerImageSizeNames']
        );
    }

    /**
     * Register custom image sizes.
     */
    private function registerImageSizes(): void
    {
        add_image_size(
            'wildtours-featured',
            1600,
            900,
            true
        );

        add_image_size(
            'wildtours-hero',
            1920,
            1080,
            true
        );

        add_image_size(
            'wildtours-card',
            768,
            512,
            true
        );

        add_image_size(
            'wildtours-thumbnail',
            480,
            320,
            true
        );

        add_image_size(
            'wildtours-square',
            600,
            600,
            true
        );
    }

    /**
     * Add custom image sizes to Media Library.
     *
     * @param array<string,string> $sizes
     * @return array<string,string>
     */
    public function registerImageSizeNames(array $sizes): array
    {
        return array_merge(
            $sizes,
            [
                'wildtours-featured' => esc_html__(
                    'Featured Image',
                    'wildtours-base'
                ),
                'wildtours-hero' => esc_html__(
                    'Hero Image',
                    'wildtours-base'
                ),
                'wildtours-card' => esc_html__(
                    'Card Image',
                    'wildtours-base'
                ),
                'wildtours-thumbnail' => esc_html__(
                    'Thumbnail',
                    'wildtours-base'
                ),
                'wildtours-square' => esc_html__(
                    'Square',
                    'wildtours-base'
                ),
            ]
        );
    }
}