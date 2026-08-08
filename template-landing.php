<?php

/**
 * Template Name: Landing Page
 * Template Post Type: page
 *
 * Marketing landing template with an optional hero band.
 *
 * Optional post meta fields:
 * - _pwt_landing_kicker     Small label above the title.
 * - _pwt_landing_subtitle   Supporting text under the title.
 * - _pwt_landing_cta_label  Call-to-action button text.
 * - _pwt_landing_cta_url    Call-to-action button URL.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

get_header();

while (have_posts()) :

    the_post();

    $postId       = get_the_ID();
    $kicker       = (string) get_post_meta($postId, '_pwt_landing_kicker', true);
    $subtitle     = (string) get_post_meta($postId, '_pwt_landing_subtitle', true);
    $ctaLabel     = (string) get_post_meta($postId, '_pwt_landing_cta_label', true);
    $ctaUrl       = (string) get_post_meta($postId, '_pwt_landing_cta_url', true);

    $hasHero = $kicker !== '' || $subtitle !== '' || $ctaLabel !== '' || has_post_thumbnail();
    ?>

    <?php if ($hasHero) : ?>

        <section class="pwt-landing-hero">
            <div class="pwt-landing-hero-inner">

                <?php if ($kicker !== '') : ?>
                    <p class="pwt-landing-kicker"><?php echo esc_html($kicker); ?></p>
                <?php endif; ?>

                <h1 class="pwt-landing-title"><?php the_title(); ?></h1>

                <?php if ($subtitle !== '') : ?>
                    <p class="pwt-landing-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>

                <?php if ($ctaLabel !== '' && $ctaUrl !== '') : ?>
                    <a class="pwt-btn pwt-landing-cta" href="<?php echo esc_url($ctaUrl); ?>">
                        <?php echo esc_html($ctaLabel); ?>
                    </a>
                <?php endif; ?>

            </div>

            <?php if (has_post_thumbnail()) : ?>
                <div class="pwt-landing-hero-media">
                    <?php the_post_thumbnail('hero', ['loading' => 'eager', 'fetchpriority' => 'high', 'decoding' => 'async']); ?>
                </div>
            <?php endif; ?>
        </section>

    <?php endif; ?>

    <article
        id="post-<?php the_ID(); ?>"
        <?php post_class('page pwt-landing-content'); ?>
    >

        <div class="entry-content">

            <?php
            the_content();

            wp_link_pages([
                'before' => '<nav class="page-links">',
                'after'  => '</nav>',
            ]);
            ?>

        </div>

    </article>

    <?php
endwhile;

get_footer();
