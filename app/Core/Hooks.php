<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

/**
 * Centralized WordPress Hooks Manager.
 *
 * All add_action() and add_filter() calls should go through this class.
 */
final class Hooks
{
    /**
     * Register a WordPress action.
     *
     * @param string $hook
     * @param object|string $component
     * @param string $method
     * @param int $priority
     * @param int $acceptedArgs
     */
    public function action(
        string $hook,
        object|string $component,
        string $method,
        int $priority = 10,
        int $acceptedArgs = 1
    ): void {
        add_action(
            $hook,
            [$component, $method],
            $priority,
            $acceptedArgs
        );
    }

    /**
     * Register a WordPress filter.
     *
     * @param string $hook
     * @param object|string $component
     * @param string $method
     * @param int $priority
     * @param int $acceptedArgs
     */
    public function filter(
        string $hook,
        object|string $component,
        string $method,
        int $priority = 10,
        int $acceptedArgs = 1
    ): void {
        add_filter(
            $hook,
            [$component, $method],
            $priority,
            $acceptedArgs
        );
    }

    /**
     * Remove an action.
     */
    public function removeAction(
        string $hook,
        object|string $component,
        string $method,
        int $priority = 10
    ): void {
        remove_action(
            $hook,
            [$component, $method],
            $priority
        );
    }

    /**
     * Remove a filter.
     */
    public function removeFilter(
        string $hook,
        object|string $component,
        string $method,
        int $priority = 10
    ): void {
        remove_filter(
            $hook,
            [$component, $method],
            $priority
        );
    }
}