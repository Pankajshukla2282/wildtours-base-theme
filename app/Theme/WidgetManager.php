<?php

declare(strict_types=1);

namespace WildTours\Base\Theme;

defined('ABSPATH') || exit;

/**
 * Registers widget areas.
 *
 * @package WildTours\Base
 */
final class WidgetManager
{
    /**
     * Boot widget registration.
     */
    public function boot(): void
    {
        add_action(
            'widgets_init',
            [$this, 'register']
        );
    }

    /**
     * Register all widget areas.
     */
    public function register(): void
    {
        $this->registerPrimarySidebar();

        $this->registerFooterWidgets();

        /**
         * Allow child themes and plugins
         * to register additional sidebars.
         */
        do_action(
            'wildtours/base/register_sidebars'
        );
    }

    /**
     * Register primary sidebar.
     */
    private function registerPrimarySidebar(): void
    {
        register_sidebar([
            'name'          => esc_html__(
                'Primary Sidebar',
                'wildtours-base'
            ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__(
                'Main sidebar displayed on posts and pages.',
                'wildtours-base'
            ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ]);
    }

    /**
     * Register footer widget areas.
     */
    private function registerFooterWidgets(): void
    {
        foreach (range(1, 4) as $column) {

            register_sidebar([
                'name' => sprintf(
                    esc_html__(
                        'Footer %d',
                        'wildtours-base'
                    ),
                    $column
                ),

                'id' => sprintf(
                    'footer-%d',
                    $column
                ),

                'description' => sprintf(
                    esc_html__(
                        'Footer widget area %d.',
                        'wildtours-base'
                    ),
                    $column
                ),

                'before_widget' => '<section id="%1$s" class="widget %2$s">',

                'after_widget' => '</section>',

                'before_title' => '<h2 class="widget-title">',

                'after_title' => '</h2>',
            ]);
        }
    }

    /**
     * Check whether any footer widget area is active.
     */
    public function hasFooterWidgets(): bool
    {
        foreach (range(1, 4) as $column) {

            if (is_active_sidebar("footer-{$column}")) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return active footer widget count.
     */
    public function getActiveFooterCount(): int
    {
        $count = 0;

        foreach (range(1, 4) as $column) {

            if (is_active_sidebar("footer-{$column}")) {
                ++$count;
            }
        }

        return $count;
    }
}