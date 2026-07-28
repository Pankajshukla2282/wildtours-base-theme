<?php

declare(strict_types=1);

namespace WildTours\Base\Core\Contracts;

interface Bootable
{
    public function register(): void;

    public function boot(): void;
}