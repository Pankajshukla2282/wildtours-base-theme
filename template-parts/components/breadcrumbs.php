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
if (
    ! has_action('wildtours/base/breadcrumbs')
    && ! function_exists('yoast_breadcrumb')
    && ! function_exists('rank_math_the_breadcrumbs')
    && ! function_exists('bcn_display')
) {
    return;
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
    if (has_action('wildtours/base/breadcrumbs')) {

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

    }

    ?>

</nav>