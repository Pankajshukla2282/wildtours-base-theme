<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('wildtours_body_classes')) {

    /**
     * Returns the default body classes.
     *
     * This helper exists for backward compatibility.
     *
     * @return array<int,string>
     */
    function wildtours_body_classes(): array
    {
        $classes = [];

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

        /**
         * Allow extensions.
         */
        return apply_filters(
            'wildtours/base/body_classes',
            array_unique($classes)
        );
    }
}

if (!function_exists('wildtours_archive_title')) {

    /**
     * Returns a simplified archive title.
     */
    function wildtours_archive_title(): string
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

        if (is_search()) {
            return sprintf(
                esc_html__(
                    'Search Results for "%s"',
                    'wildtours-base'
                ),
                get_search_query()
            );
        }

        return get_the_archive_title();
    }
}

if (!function_exists('wildtours_excerpt_length')) {

    /**
     * Default excerpt length.
     */
    function wildtours_excerpt_length(): int
    {
        return (int) apply_filters(
            'wildtours/base/excerpt_length',
            30
        );
    }
}

if (!function_exists('wildtours_excerpt_more')) {

    /**
     * Default excerpt suffix.
     */
    function wildtours_excerpt_more(): string
    {
        return (string) apply_filters(
            'wildtours/base/excerpt_more',
            '&hellip;'
        );
    }
}

if (!function_exists('wildtours_sidebar_layout')) {

    /**
     * Returns the sidebar layout for the current view.
     *
     * Values: 'none' (default), 'right'.
     *
     * @return string
     */
    function wildtours_sidebar_layout(): string
    {
        $layout = (string) get_theme_mod(
            'sidebar_layout',
            'none'
        );

        return (string) apply_filters(
            'wildtours/base/sidebar_layout',
            $layout
        );
    }
}

if (!function_exists('wildtours_show_sidebar')) {

    /**
     * Whether the primary sidebar should render on this view.
     */
    function wildtours_show_sidebar(): bool
    {
        if (!is_active_sidebar('sidebar-1')) {
            return false;
        }

        if (!in_array(wildtours_sidebar_layout(), ['right'], true)) {
            return false;
        }

        if (is_singular()) {
            $postType = get_post_type();

            if (
                is_string($postType)
                && str_starts_with($postType, 'pwt_')
            ) {
                return false;
            }
        }

        if (is_post_type_archive() && str_starts_with((string) get_post_type(), 'pwt_')) {
            return false;
        }

        return true;
    }
}

if (!function_exists('wildtours_pingback_header')) {

    /**
     * Prints the pingback header.
     *
     * Exists for compatibility with classic themes.
     */
    function wildtours_pingback_header(): void
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
}