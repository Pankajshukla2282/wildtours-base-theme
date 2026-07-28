<?php

declare(strict_types=1);

namespace WildTours\Base\Core;

/**
 * Block editor service.
 */
final class Editor extends AbstractService
{
    /**
     * Register hooks.
     */
    public function register(): void
    {
        $this->hooks->action(
            'after_setup_theme',
            $this,
            'setup'
        );
    }

    /**
     * Configure the block editor.
     */
    public function setup(): void
    {
        $this->registerColorPalette();

        $this->registerFontSizes();

        $this->registerGradients();

        $this->disableCustomColors();

        $this->disableCustomFontSizes();
    }

    /**
     * Register editor colors.
     */
    private function registerColorPalette(): void
    {
        add_theme_support(
            'editor-color-palette',
            $this->config->section('editor.colors')
        );
    }

    /**
     * Register editor font sizes.
     */
    private function registerFontSizes(): void
    {
        add_theme_support(
            'editor-font-sizes',
            $this->config->section('editor.font_sizes')
        );
    }

    /**
     * Register gradients.
     */
    private function registerGradients(): void
    {
        add_theme_support(
            'editor-gradient-presets',
            $this->config->section('editor.gradients')
        );
    }

    /**
     * Disable custom colors.
     */
    private function disableCustomColors(): void
    {
        add_theme_support(
            'disable-custom-colors'
        );
    }

    /**
     * Disable custom font sizes.
     */
    private function disableCustomFontSizes(): void
    {
        add_theme_support(
            'disable-custom-font-sizes'
        );
    }
}