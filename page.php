<?php

/**
 * The template for displaying all pages.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

get_header();

while (have_posts()) :

    the_post();

    get_template_part(
        'template-parts/content/content',
        'page'
    );

endwhile;

get_footer();