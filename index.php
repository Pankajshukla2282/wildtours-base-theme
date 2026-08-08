<?php

/**
 * Main template file.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

get_header();

if (have_posts()) {

    while (have_posts()) {
        the_post();

        get_template_part(
            'template-parts/content/content',
            get_post_type()
        );
    }

    get_template_part(
        'template-parts/navigation/posts'
    );

} else {

    get_template_part(
        'template-parts/content/content',
        'none'
    );
}

get_footer();