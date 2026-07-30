<?php

declare(strict_types=1);

namespace WildTours\Base\Blocks;

defined('ABSPATH') || exit;

/**
 * Registers block-related theme features.
 */
final class BlockManager
{
    /**
     * Register WordPress hooks.
     */
    public function register(): void
    {
        add_action(
            'after_setup_theme',
            [$this, 'registerFeatures']
        );

        add_action(
            'init',
            [$this, 'registerPatterns']
        );

        add_action(
            'init',
            [$this, 'registerPatternCategories']
        );
    }

    /**
     * Register block editor features.
     */
    public function registerFeatures(): void
    {
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
        add_theme_support('editor-styles');
        add_theme_support('appearance-tools');
        add_theme_support('custom-spacing');
        add_theme_support('custom-line-height');
    }

    /**
     * Register pattern categories.
     */
    public function registerPatternCategories(): void
    {
        if (!function_exists('register_block_pattern_category')) {
            return;
        }

        register_block_pattern_category(
            'wildtours',
            [
                'label' => __('WildTours', 'wildtours-base'),
            ]
        );
    }

    /**
     * Register bundled patterns.
     */
    public function registerPatterns(): void
    {
        $directory = get_template_directory() . '/patterns';

        if (!is_dir($directory)) {
            return;
        }

        foreach (glob($directory . '/*.php') ?: [] as $file) {
            require_once $file;
        }
    }
}