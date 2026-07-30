<?php

/**
 * Site Branding
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$has_logo = function_exists('has_custom_logo') && has_custom_logo();
?>

<div class="site-branding">

    <?php if ($has_logo) : ?>

        <div class="site-logo">
            <?php the_custom_logo(); ?>
        </div>

    <?php else : ?>

        <<?php echo is_front_page() && is_home() ? 'h1' : 'div'; ?>
            class="site-title">

            <a
                href="<?php echo esc_url(home_url('/')); ?>"
                rel="home">

                <?php bloginfo('name'); ?>

            </a>

        </<?php echo is_front_page() && is_home() ? 'h1' : 'div'; ?>>

    <?php endif; ?>

    <?php
    $description = get_bloginfo('description', 'display');

    if ($description || is_customize_preview()) :
    ?>

        <p class="site-description">
            <?php echo esc_html($description); ?>
        </p>

    <?php endif; ?>

</div>