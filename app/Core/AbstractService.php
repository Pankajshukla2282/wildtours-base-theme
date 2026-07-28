<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

use WildTours\Base\Core\Contracts\ServiceInterface;

abstract class AbstractService implements ServiceInterface
{
    protected Hooks $hooks;

    protected Config $config;

    public function __construct(
        Hooks $hooks,
        Config $config
    ) {
        $this->hooks = $hooks;

        $this->config = $config;
    }
}