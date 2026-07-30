<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('wildtours_posted_on')) {

    /**
     * Prints the published/modified date.
     */
    function wildtours_posted_on(): void
    {
        $published = sprintf(
            '<time class="entry-date published" datetime="%1$s">%2$s</time>',
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date())
        );

        $updated = '';

        if (get_the_modified_time('U') !== get_the_time('U')) {
            $updated = sprintf(
                '<time class="updated" datetime="%1$s">%2$s</time>',
                esc_attr(get_the_modified_date(DATE_W3C)),
                esc_html(get_the_modified_date())
            );
        }

        printf(
            '<span class="posted-on">%s%s</span>',
            $published, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            $updated // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        );
    }
}

if (!function_exists('wildtours_posted_by')) {

    /**
     * Prints author information.
     */
    function wildtours_posted_by(): void
    {
        printf(
            '<span class="byline"><a href="%1$s" rel="author">%2$s</a></span>',
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_html(get_the_author())
        );
    }
}

if (!function_exists('wildtours_entry_meta')) {

    /**
     * Prints entry meta.
     */
    function wildtours_entry_meta(): void
    {
        echo '<div class="entry-meta">';

        wildtours_posted_on();

        wildtours_posted_by();

        /**
         * Extension point.
         */
        do_action('wildtours/base/entry_meta');

        echo '</div>';
    }
}

if (!function_exists('wildtours_entry_footer')) {

    /**
     * Prints categories, tags and edit link.
     */
    function wildtours_entry_footer(): void
    {
        echo '<footer class="entry-footer">';

        if ('post' === get_post_type()) {

            $categories = get_the_category_list(', ');

            if (!empty($categories)) {

                printf(
                    '<span class="cat-links">%s</span>',
                    $categories // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                );
            }

            $tags = get_the_tag_list('', ', ');

            if (!empty($tags)) {

                printf(
                    '<span class="tags-links">%s</span>',
                    $tags // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                );
            }
        }

        edit_post_link(
            esc_html__('Edit', 'wildtours-base'),
            '<span class="edit-link">',
            '</span>'
        );

        do_action('wildtours/base/entry_footer');

        echo '</footer>';
    }
}

if (!function_exists('wildtours_post_thumbnail')) {

    /**
     * Prints featured image.
     */
    function wildtours_post_thumbnail(
        string $size = 'post-thumbnail'
    ): void {

        if (
            post_password_required()
            || is_attachment()
            || !has_post_thumbnail()
        ) {
            return;
        }

        if (is_singular()) {

            echo '<div class="post-thumbnail">';

            the_post_thumbnail(
                $size,
                [
                    'loading' => 'eager',
                    'fetchpriority' => 'high',
                    'decoding' => 'async',
                ]
            );

            echo '</div>';

            return;
        }

        ?>

        <a
            class="post-thumbnail"
            href="<?php the_permalink(); ?>"
            aria-hidden="true"
            tabindex="-1"
        >

            <?php

            the_post_thumbnail(
                $size,
                [
                    'loading' => 'lazy',
                    'decoding' => 'async',
                ]
            );

            ?>

        </a>

        <?php
    }
}

if (!function_exists('wildtours_comments_link')) {

    /**
     * Prints comments link.
     */
    function wildtours_comments_link(): void
    {
        if (
            post_password_required()
            || comments_open() === false && get_comments_number() === 0
        ) {
            return;
        }

        echo '<span class="comments-link">';

        comments_popup_link(
            esc_html__('Leave a comment', 'wildtours-base'),
            esc_html__('1 Comment', 'wildtours-base'),
            esc_html__('% Comments', 'wildtours-base')
        );

        echo '</span>';
    }
}

if (!function_exists('wildtours_edit_post_link')) {

    /**
     * Prints edit link.
     */
    function wildtours_edit_post_link(): void
    {
        edit_post_link(
            esc_html__('Edit', 'wildtours-base'),
            '<span class="edit-link">',
            '</span>'
        );
    }
}