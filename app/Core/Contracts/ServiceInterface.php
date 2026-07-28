<?php

declare(strict_types=1);

namespace WildTours\Base\Core\Contracts;

/**
 * Every framework service must implement this interface.
 */
interface ServiceInterface
{
    /**
     * Register all WordPress hooks.
     */
    public function register(): void;
}