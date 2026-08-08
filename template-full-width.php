<?php

/**
 * Template Name: Full Width Page
 * Template Post Type: page
 *
 * Full-width page layout without a sidebar.
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
