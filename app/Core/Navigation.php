<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

/**
 * Navigation service.
 *
 * Handles navigation-related behavior and rendering.
 */
final class Navigation extends AbstractService
{
    /**
     * Register hooks.
     */
    public function register(): void
    {
        $this->hooks->filter(
            'nav_menu_css_class',
            $this,
            'filterMenuClasses',
            10,
            4
        );

        $this->hooks->filter(
            'nav_menu_link_attributes',
            $this,
            'filterLinkAttributes',
            10,
            4
        );

        $this->hooks->filter(
            'body_class',
            $this,
            'filterBodyClasses'
        );
    }

    /**
     * Render a navigation menu.
     */
    public function render(array $args = []): void
    {
        $defaults = [

            'theme_location' => 'primary',

            'container' => 'nav',

            'container_class' => 'site-navigation',

            'menu_class' => 'menu',

            'fallback_cb' => false,

            'depth' => 2,

        ];

        wp_nav_menu(
            wp_parse_args(
                $args,
                $defaults
            )
        );
    }

    /**
     * Filter menu item classes.
     */
    public function filterMenuClasses(
        array $classes,
        \WP_Post $item,
        \stdClass $args,
        int $depth
    ): array {

        if (in_array('current-menu-item', $classes, true)) {

            $classes[] = 'is-active';
        }

        if (in_array('menu-item-has-children', $classes, true)) {

            $classes[] = 'has-submenu';
        }

        return array_unique($classes);
    }

    /**
     * Filter menu link attributes.
     */
    public function filterLinkAttributes(
        array $atts,
        \WP_Post $item,
        \stdClass $args,
        int $depth
    ): array {

        if (in_array('menu-item-has-children', $item->classes, true)) {

            $atts['aria-haspopup'] = 'true';

            $atts['aria-expanded'] = 'false';
        }

        return $atts;
    }

    /**
     * Filter body classes.
     */
    public function filterBodyClasses(
        array $classes
    ): array {

        if (has_nav_menu('primary')) {

            $classes[] = 'has-primary-navigation';
        }

        return $classes;
    }
}