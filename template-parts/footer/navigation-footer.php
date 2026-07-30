<?php

/**
 * Footer Navigation
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

wp_nav_menu([
    'theme_location' => 'footer',
    'container'      => 'nav',
    'container_class'=> 'footer-navigation',
    'container_aria_label' => __('Footer Navigation', 'wildtours-base'),
    'fallback_cb'    => false,
]);