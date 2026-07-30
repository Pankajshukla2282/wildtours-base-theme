<?php

/**
 * Front Page Template
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

get_header();

if (have_posts()) :

    while (have_posts()) :

        the_post();

        /*
         * Use the page content as the homepage.
         * This allows child themes and the block editor
         * to build completely custom homepages.
         */
        get_template_part(
            'template-parts/content/content',
            'page'
        );

    endwhile;

endif;

get_footer();