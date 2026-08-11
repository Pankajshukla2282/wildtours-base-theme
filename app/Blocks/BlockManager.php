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
            'init',
            [$this, 'registerPatternCategories']
        );
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
}