<?php

/**
 * Template Name: No Title Page
 * Template Post Type: page
 *
 * Renders page content without the title header.
 * Useful for landing pages where the hero handles it.
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
        'page-no-title'
    );

endwhile;

get_footer();
