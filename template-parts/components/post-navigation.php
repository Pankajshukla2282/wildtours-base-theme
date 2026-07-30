<?php

/**
 * Post Navigation Component
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!is_singular('post')) {
    return;
}

$args = [
    'screen_reader_text' => esc_html__(
        'Post navigation',
        'wildtours-base'
    ),

    'prev_text' => sprintf(
        '<span class="nav-subtitle">%s</span><span class="nav-title">%%title</span>',
        esc_html__('Previous', 'wildtours-base')
    ),

    'next_text' => sprintf(
        '<span class="nav-subtitle">%s</span><span class="nav-title">%%title</span>',
        esc_html__('Next', 'wildtours-base')
    ),
];

/**
 * Filter post navigation arguments.
 */
$args = apply_filters(
    'wildtours/base/post_navigation_args',
    $args
);

?>

<nav
    class="post-navigation"
    aria-label="<?php esc_attr_e(
        'Post navigation',
        'wildtours-base'
    ); ?>"
>

    <?php the_post_navigation($args); ?>

</nav>