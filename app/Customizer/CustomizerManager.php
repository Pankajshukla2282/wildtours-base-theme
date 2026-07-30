<?php

declare(strict_types=1);

namespace WildTours\Base\Customizer;

defined('ABSPATH') || exit;

/**
 * Registers theme Customizer settings.
 */
final class CustomizerManager
{
    /**
     * Register hooks.
     */
    public function register(): void
    {
        add_action(
            'customize_register',
            [$this, 'customize']
        );
    }

    /**
     * Register theme customization options.
     */
    public function customize(\WP_Customize_Manager $wp_customize): void
    {
        $wp_customize->add_section(
            'wildtours_layout',
            [
                'title'    => __('Layout', 'wildtours-base'),
                'priority' => 30,
            ]
        );

        $wp_customize->add_setting(
            'container_width',
            [
                'default'           => '1200',
                'sanitize_callback' => 'absint',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'container_width',
            [
                'label'       => __('Container Width (px)', 'wildtours-base'),
                'section'     => 'wildtours_layout',
                'type'        => 'number',
                'input_attrs' => [
                    'min'  => 960,
                    'max'  => 1600,
                    'step' => 10,
                ],
            ]
        );
    }
}