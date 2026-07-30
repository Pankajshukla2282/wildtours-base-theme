<?php

declare(strict_types=1);

namespace WildTours\Base\Theme;

defined('ABSPATH') || exit;

/**
 * Registers global theme hooks.
 *
 * @package WildTours\Base
 */
final class Hooks
{
    /**
     * Boot hooks.
     */
    public function boot(): void
    {
        add_action(
            'wp_head',
            [$this, 'pingbackHeader']
        );

        add_filter(
            'body_class',
            [$this, 'bodyClasses']
        );

        add_filter(
            'excerpt_more',
            [$this, 'excerptMore']
        );

        add_filter(
            'excerpt_length',
            [$this, 'excerptLength'],
            20
        );

        add_filter(
            'get_the_archive_title',
            [$this, 'archiveTitle']
        );

        /**
         * Uncomment only if you intentionally want
         * to disable WordPress automatic image scaling.
         */
        // add_filter(
        //     'big_image_size_threshold',
        //     '__return_false'
        // );
    }

    /**
     * Add pingback URL for singular pages.
     */
    public function pingbackHeader(): void
    {
        if (
            is_singular()
            && pings_open()
        ) {
            printf(
                '<link rel="pingback" href="%s">',
                esc_url(
                    get_bloginfo('pingback_url')
                )
            );
        }
    }

    /**
     * Add custom body classes.
     *
     * @param array<int,string> $classes
     * @return array<int,string>
     */
    public function bodyClasses(array $classes): array
    {
        if (!is_singular()) {
            $classes[] = 'hfeed';
        }

        if (!is_active_sidebar('sidebar-1')) {
            $classes[] = 'no-sidebar';
        }

        if (has_custom_logo()) {
            $classes[] = 'has-custom-logo';
        }

        if (wp_is_block_theme()) {
            $classes[] = 'is-block-theme';
        } else {
            $classes[] = 'is-classic-theme';
        }

        return array_unique($classes);
    }

    /**
     * Customize excerpt more text.
     */
    public function excerptMore(): string
    {
        return '&hellip;';
    }

    /**
     * Customize excerpt length.
     */
    public function excerptLength(): int
    {
        return 30;
    }

    /**
     * Simplify archive titles.
     */
    public function archiveTitle(string $title): string
    {
        if (is_category()) {
            return single_cat_title('', false);
        }

        if (is_tag()) {
            return single_tag_title('', false);
        }

        if (is_author()) {
            return get_the_author();
        }

        if (is_post_type_archive()) {
            return post_type_archive_title('', false);
        }

        return $title;
    }
}