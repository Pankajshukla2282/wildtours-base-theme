<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

/**
 * Widget Service.
 *
 * Responsible for registering widget areas.
 */
final class Widgets extends AbstractService
{
    /**
     * Register WordPress hooks.
     */
    public function register(): void
    {
        $this->hooks->action(
            'widgets_init',
            $this,
            'registerSidebars'
        );
    }

    /**
     * Register widget areas.
     */
    public function registerSidebars(): void
    {
        foreach ($this->config->section('sidebars') as $id => $sidebar) {

            register_sidebar([
                'id'            => $id,
                'name'          => __(
                    $sidebar['name'],
                    $this->config->get('theme.text_domain')
                ),
                'description'   => __(
                    $sidebar['description'],
                    $this->config->get('theme.text_domain')
                ),
                'before_widget' => $sidebar['before_widget'],
                'after_widget'  => $sidebar['after_widget'],
                'before_title'  => $sidebar['before_title'],
                'after_title'   => $sidebar['after_title'],
            ]);
        }
    }
}