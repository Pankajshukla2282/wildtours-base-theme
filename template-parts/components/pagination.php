<?php

/**
 * Pagination Component
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

global $wp_query;

if (
    ! isset($wp_query)
    || (int) $wp_query->max_num_pages < 2
) {
    return;
}

$args = [
    'mid_size'           => 2,
    'end_size'           => 1,
    'prev_text'          => esc_html__('Previous', 'wildtours-base'),
    'next_text'          => esc_html__('Next', 'wildtours-base'),
    'screen_reader_text' => esc_html__(
        'Posts navigation',
        'wildtours-base'
    ),
    'type'               => 'list',
];

$args = apply_filters(
    'wildtours/base/pagination_args',
    $args
);

?>

<nav
    class="pagination"
    aria-label="<?php esc_attr_e(
        'Pagination',
        'wildtours-base'
    ); ?>"
>

    <?php
    the_posts_pagination($args);
    ?>

</nav>