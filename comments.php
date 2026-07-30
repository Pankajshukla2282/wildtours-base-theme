<?php

/**
 * Comments template.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (post_password_required()) {
    return;
}
?>

<section id="comments" class="comments-area">

    <?php if (have_comments()) : ?>

        <h2 class="comments-title">

            <?php
            printf(
                esc_html(
                    _n(
                        '%s Comment',
                        '%s Comments',
                        get_comments_number(),
                        'wildtours-base'
                    )
                ),
                number_format_i18n(get_comments_number())
            );
            ?>

        </h2>

        <ol class="comment-list">

            <?php
            wp_list_comments([
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 60,
            ]);
            ?>

        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php comment_form(); ?>

</section>