<?php

/**
 * Sidebar.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside
    id="secondary"
    class="widget-area"
    role="complementary"
>

    <?php dynamic_sidebar('sidebar-1'); ?>

</aside>