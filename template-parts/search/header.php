<?php

/**
 * Search Header
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

global $wp_query;

?>

<header class="search-header">

    <h1 class="search-title">

        <?php

        printf(
            esc_html__(
                'Search Results for "%s"',
                'wildtours-base'
            ),
            esc_html(get_search_query())
        );

        ?>

    </h1>

    <p class="search-count">

        <?php

        printf(
            esc_html(
                _n(
                    '%d result found',
                    '%d results found',
                    (int) $wp_query->found_posts,
                    'wildtours-base'
                )
            ),
            (int) $wp_query->found_posts
        );

        ?>

    </p>

</header>