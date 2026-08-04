<?php

/**
 * Breadcrumb Component
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Nothing to display.
 */

$has_custom_breadcrumbs = has_action('wildtours/base/breadcrumbs');
$has_plugin_breadcrumbs = function_exists('yoast_breadcrumb')
    || function_exists('rank_math_the_breadcrumbs')
    || function_exists('bcn_display');

if (! $has_custom_breadcrumbs && ! $has_plugin_breadcrumbs && is_front_page() && ! is_home()) {
    return;
}

$trail = [];

$trail[] = [
    'label' => __('Home', 'wildtours-base'),
    'url'   => home_url('/'),
];

if (!$has_custom_breadcrumbs && !$has_plugin_breadcrumbs) {
    if (is_home()) {
        $posts_page = (int) get_option('page_for_posts');

        if ($posts_page > 0) {
            $trail[] = [
                'label' => get_the_title($posts_page),
                'url'   => get_permalink($posts_page),
            ];
        }
    } elseif (is_singular()) {
        $post_id = get_queried_object_id();

        if (is_page()) {
            $ancestors = array_reverse(get_post_ancestors($post_id));

            foreach ($ancestors as $ancestor_id) {
                $trail[] = [
                    'label' => get_the_title($ancestor_id),
                    'url'   => get_permalink($ancestor_id),
                ];
            }
        } elseif (is_single()) {
            $posts_page = (int) get_option('page_for_posts');

            if ($posts_page > 0) {
                $trail[] = [
                    'label' => get_the_title($posts_page),
                    'url'   => get_permalink($posts_page),
                ];
            }

            $terms = get_the_category($post_id);

            if (! empty($terms) && ! is_wp_error($terms)) {
                $term = $terms[0];

                $trail[] = [
                    'label' => $term->name,
                    'url'   => get_term_link($term),
                ];
            }
        }

        $trail[] = [
            'label' => get_the_title($post_id),
            'url'   => '',
        ];
    } elseif (is_post_type_archive()) {
        $trail[] = [
            'label' => post_type_archive_title('', false),
            'url'   => '',
        ];
    } elseif (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();

        if ($term instanceof WP_Term) {
            $parents = array_reverse(get_ancestors($term->term_id, $term->taxonomy));

            foreach ($parents as $parent_id) {
                $parent_term = get_term($parent_id, $term->taxonomy);

                if ($parent_term && ! is_wp_error($parent_term)) {
                    $trail[] = [
                        'label' => $parent_term->name,
                        'url'   => get_term_link($parent_term),
                    ];
                }
            }

            $trail[] = [
                'label' => single_term_title('', false),
                'url'   => '',
            ];
        }
    } elseif (is_search()) {
        $trail[] = [
            'label' => sprintf(
                esc_html__('Search results for "%s"', 'wildtours-base'),
                get_search_query()
            ),
            'url'   => '',
        ];
    } elseif (is_404()) {
        $trail[] = [
            'label' => esc_html__('404 Not Found', 'wildtours-base'),
            'url'   => '',
        ];
    } else {
        $trail[] = [
            'label' => get_the_archive_title(),
            'url'   => '',
        ];
    }
}

?>

<nav
    class="breadcrumbs"
    aria-label="<?php esc_attr_e('Breadcrumb', 'wildtours-base'); ?>"
>

    <?php

    /**
     * Theme/child-theme hook.
     */
    if ($has_custom_breadcrumbs) {

        do_action('wildtours/base/breadcrumbs');

    } elseif (function_exists('yoast_breadcrumb')) {

        yoast_breadcrumb(
            '<span class="breadcrumb-trail">',
            '</span>'
        );

    } elseif (function_exists('rank_math_the_breadcrumbs')) {

        rank_math_the_breadcrumbs();

    } elseif (function_exists('bcn_display')) {

        bcn_display();

    } else {

        ?>

        <ol class="breadcrumb-trail">

            <?php foreach ($trail as $index => $item) : ?>

                <li class="breadcrumb-item">

                    <?php if ($index === array_key_last($trail) || empty($item['url'])) : ?>
                        <span aria-current="page"><?php echo esc_html($item['label']); ?></span>
                    <?php else : ?>
                        <a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
                    <?php endif; ?>

                </li>

            <?php endforeach; ?>

        </ol>

        <?php

    }

    ?>

</nav>