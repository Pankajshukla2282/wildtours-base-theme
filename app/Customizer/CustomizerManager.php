<?php

declare(strict_types=1);

namespace WildTours\Base\Customizer;

defined('ABSPATH') || exit;

/**
 * Registers theme Customizer settings.
 *
 * @package WildTours\Base
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
        $this->layoutSection($wp_customize);
        $this->headerSection($wp_customize);
        $this->contactSection($wp_customize);
        $this->footerSection($wp_customize);
        $this->ctaSection($wp_customize);
        $this->colorsSection($wp_customize);

        /**
         * Allow child themes and plugins to extend the customizer.
         */
        do_action(
            'wildtours/base/customize',
            $wp_customize
        );
    }

    /**
     * Layout options.
     */
    private function layoutSection(\WP_Customize_Manager $wp_customize): void
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

        $wp_customize->add_setting(
            'sidebar_layout',
            [
                'default'           => 'none',
                'sanitize_callback' => [$this, 'sanitizeChoice'],
            ]
        );

        $wp_customize->add_control(
            'sidebar_layout',
            [
                'label'       => __('Sidebar Layout', 'wildtours-base'),
                'section'     => 'wildtours_layout',
                'type'        => 'select',
                'choices'     => [
                    'none'  => __('No sidebar', 'wildtours-base'),
                    'right' => __('Sidebar on the right', 'wildtours-base'),
                ],
            ]
        );

        $wp_customize->add_setting(
            'max_post_columns',
            [
                'default'           => '3',
                'sanitize_callback' => 'absint',
            ]
        );

        $wp_customize->add_control(
            'max_post_columns',
            [
                'label'       => __('Archive Columns', 'wildtours-base'),
                'section'     => 'wildtours_layout',
                'type'        => 'select',
                'choices'     => [
                    '2' => __('2 columns', 'wildtours-base'),
                    '3' => __('3 columns', 'wildtours-base'),
                    '4' => __('4 columns', 'wildtours-base'),
                ],
            ]
        );
    }

    /**
     * Header options.
     */
    private function headerSection(\WP_Customize_Manager $wp_customize): void
    {
        $wp_customize->add_section(
            'wildtours_header',
            [
                'title'    => __('Header', 'wildtours-base'),
                'priority' => 32,
            ]
        );

        $wp_customize->add_setting(
            'topbar_text',
            [
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        $wp_customize->add_control(
            'topbar_text',
            [
                'label'       => __('Top Bar Text', 'wildtours-base'),
                'description' => __('Shown above the main navigation.', 'wildtours-base'),
                'section'     => 'wildtours_header',
                'type'        => 'text',
            ]
        );

        $wp_customize->add_setting(
            'header_cta_label',
            [
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        $wp_customize->add_setting(
            'header_cta_url',
            [
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            ]
        );

        $wp_customize->add_control(
            'header_cta_label',
            [
                'label'   => __('Header CTA Label', 'wildtours-base'),
                'section' => 'wildtours_header',
                'type'    => 'text',
            ]
        );

        $wp_customize->add_control(
            'header_cta_url',
            [
                'label'   => __('Header CTA URL', 'wildtours-base'),
                'section' => 'wildtours_header',
                'type'    => 'url',
            ]
        );
    }

    /**
     * Contact options.
     */
    private function contactSection(\WP_Customize_Manager $wp_customize): void
    {
        $wp_customize->add_section(
            'wildtours_contact',
            [
                'title'    => __('Contact', 'wildtours-base'),
                'priority' => 34,
            ]
        );

        $wp_customize->add_setting(
            'contact_phone',
            [
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        $wp_customize->add_setting(
            'contact_email',
            [
                'default'           => '',
                'sanitize_callback' => 'sanitize_email',
            ]
        );

        $wp_customize->add_setting(
            'whatsapp_number',
            [
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        $wp_customize->add_control(
            'contact_phone',
            [
                'label'   => __('Phone', 'wildtours-base'),
                'section' => 'wildtours_contact',
                'type'    => 'text',
            ]
        );

        $wp_customize->add_control(
            'contact_email',
            [
                'label'   => __('Email', 'wildtours-base'),
                'section' => 'wildtours_contact',
                'type'    => 'email',
            ]
        );

        $wp_customize->add_control(
            'whatsapp_number',
            [
                'label'       => __('WhatsApp Number', 'wildtours-base'),
                'description' => __('International format, e.g. +919876543210. Enables the floating chat button.', 'wildtours-base'),
                'section'     => 'wildtours_contact',
                'type'        => 'text',
            ]
        );
    }

    /**
     * Footer options.
     */
    private function footerSection(\WP_Customize_Manager $wp_customize): void
    {
        $wp_customize->add_section(
            'wildtours_footer',
            [
                'title'    => __('Footer', 'wildtours-base'),
                'priority' => 36,
            ]
        );

        $wp_customize->add_setting(
            'footer_copyright',
            [
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            ]
        );

        $wp_customize->add_control(
            'footer_copyright',
            [
                'label'   => __('Copyright Text', 'wildtours-base'),
                'section' => 'wildtours_footer',
                'type'    => 'textarea',
            ]
        );

        $networks = [
            'facebook'  => __('Facebook URL', 'wildtours-base'),
            'instagram' => __('Instagram URL', 'wildtours-base'),
            'youtube'   => __('YouTube URL', 'wildtours-base'),
            'twitter'   => __('X / Twitter URL', 'wildtours-base'),
            'linkedin'  => __('LinkedIn URL', 'wildtours-base'),
        ];

        foreach ($networks as $network => $label) {

            $wp_customize->add_setting(
                "social_{$network}",
                [
                    'default'           => '',
                    'sanitize_callback' => 'esc_url_raw',
                ]
            );

            $wp_customize->add_control(
                "social_{$network}",
                [
                    'label'   => $label,
                    'section' => 'wildtours_footer',
                    'type'    => 'url',
                ]
            );
        }
    }

    /**
     * Call-to-action band defaults.
     */
    private function ctaSection(\WP_Customize_Manager $wp_customize): void
    {
        $wp_customize->add_section(
            'wildtours_cta',
            [
                'title'    => __('Call to Action', 'wildtours-base'),
                'priority' => 38,
            ]
        );

        $settings = [
            'cta_title'           => [__('CTA Title', 'wildtours-base'), 'sanitize_text_field', 'text'],
            'cta_text'            => [__('CTA Text', 'wildtours-base'), 'sanitize_textarea_field', 'textarea'],
            'cta_primary_url'     => [__('Primary Button URL', 'wildtours-base'), 'esc_url_raw', 'url'],
            'cta_primary_label'   => [__('Primary Button Label', 'wildtours-base'), 'sanitize_text_field', 'text'],
            'cta_secondary_url'   => [__('Secondary Button URL', 'wildtours-base'), 'esc_url_raw', 'url'],
            'cta_secondary_label' => [__('Secondary Button Label', 'wildtours-base'), 'sanitize_text_field', 'text'],
        ];

        foreach ($settings as $key => [$label, $sanitize, $type]) {

            $wp_customize->add_setting(
                $key,
                [
                    'default'           => '',
                    'sanitize_callback' => $sanitize,
                ]
            );

            $wp_customize->add_control(
                $key,
                [
                    'label'   => $label,
                    'section' => 'wildtours_cta',
                    'type'    => $type,
                ]
            );
        }
    }

    /**
     * Color scheme options.
     */
    private function colorsSection(\WP_Customize_Manager $wp_customize): void
    {
        $wp_customize->add_section(
            'wildtours_colors',
            [
                'title'    => __('Colors', 'wildtours-base'),
                'priority' => 40,
            ]
        );

        $wp_customize->add_setting(
            'color_scheme',
            [
                'default'           => 'forest',
                'sanitize_callback' => [$this, 'sanitizeChoice'],
            ]
        );

        $wp_customize->add_control(
            'color_scheme',
            [
                'label'       => __('Color Scheme', 'wildtours-base'),
                'section'     => 'wildtours_colors',
                'type'        => 'select',
                'choices'     => [
                    'forest' => __('Forest (green)', 'wildtours-base'),
                    'desert' => __('Desert (amber)', 'wildtours-base'),
                    'savanna' => __('Savanna (olive)', 'wildtours-base'),
                    'ocean' => __('Ocean (blue)', 'wildtours-base'),
                ],
            ]
        );

        $wp_customize->add_setting(
            'accent_color',
            [
                'default'           => '#D97706',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'accent_color',
                [
                    'label'   => __('Accent Color', 'wildtours-base'),
                    'section' => 'wildtours_colors',
                ]
            )
        );

        $wp_customize->add_setting(
            'primary_color',
            [
                'default'           => '#2F6F3E',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'primary_color',
                [
                    'label'   => __('Primary Color', 'wildtours-base'),
                    'section' => 'wildtours_colors',
                ]
            )
        );
    }

    /**
     * Restrict a value to a known list.
     */
    public function sanitizeChoice(string $value, \WP_Customize_Setting $setting): string
    {
        $allowed = array_keys($setting->manager->get_control($setting->id)->choices ?? []);

        return in_array($value, $allowed, true) ? $value : (string) $setting->default;
    }
}
