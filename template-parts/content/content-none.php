<?php

/**
 * No content found.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<section class="no-results">

    <header class="page-header">
        <h1><?php esc_html_e('Nothing Found', 'wildtours-base'); ?></h1>
    </header>

    <div class="page-content">

        <?php if (is_search()) : ?>

            <p>

                <?php
                esc_html_e(
                    'No results matched your search. Try different keywords or browse our latest content below.',
                    'wildtours-base'
                );
                ?>

            </p>

            <?php get_search_form(); ?>

            <?php
            the_widget(
                WP_Widget_Recent_Posts::class,
                [
                    'number' => 5,
                ]
            );
            ?>

        <?php endif; ?>

    </div>

</section>