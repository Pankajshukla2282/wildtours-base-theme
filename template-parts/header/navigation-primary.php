<?php

/**
 * Primary Navigation
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<nav
    id="site-navigation"
    class="primary-navigation"
    aria-label="<?php esc_attr_e('Primary Navigation', 'wildtours-base'); ?>"
>

    <button
        class="menu-toggle"
        type="button"
        aria-controls="primary-menu"
        aria-expanded="false"
    >

        <span class="screen-reader-text">
            <?php esc_html_e('Toggle navigation', 'wildtours-base'); ?>
        </span>

        <span class="menu-toggle__icon" aria-hidden="true">
            ☰
        </span>

    </button>

    <?php

    wp_nav_menu([
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'menu_class'     => 'primary-menu',
        'container'      => false,
        'fallback_cb'    => false,
        'depth'          => 3,
    ]);

    ?>

</nav>