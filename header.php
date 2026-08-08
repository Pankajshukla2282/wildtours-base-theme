<?php

/**
 * The header for our theme.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo('charset'); ?>">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1"
/>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a
    class="screen-reader-text skip-link"
    href="#primary"
>
    <?php esc_html_e(
        'Skip to content',
        'wildtours-base'
    ); ?>
</a>

<div id="page" class="site">

    <header
        id="masthead"
        class="site-header"
        role="banner"
    >

        <?php
        get_template_part(
            'template-parts/header/topbar'
        );
        ?>

        <?php
        get_template_part(
            'template-parts/header/site',
            'branding'
        );
        ?>

        <?php
        get_template_part(
            'template-parts/header/navigation',
            'primary'
        );
        ?>

    </header>

    <?php
    get_template_part(
        'template-parts/components/breadcrumbs'
    );
    ?>

    <main
        id="primary"
        class="site-main"
    >