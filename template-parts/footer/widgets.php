<?php

/**
 * Footer Site Info
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

for ($column = 1; $column <= 4; $column++) {

    if (!is_active_sidebar("footer-{$column}")) {
        continue;
    }

    echo '<div class="footer-widget footer-widget--' . esc_attr((string) $column) . '">';

    dynamic_sidebar("footer-{$column}");

    echo '</div>';
}