<?php

/**
 * Reusable Card Component.
 *
 * Renders a consistent post card used across archives,
 * loops, shortcodes and block patterns. Fully driven by
 * $args so child themes and plugins can reshape it.
 *
 * Supported args:
 * - post          int|WP_Post  Post to display (required).
 * - image_size    string       Registered image size (default: card).
 * - show_image    bool         Whether to render the thumbnail.
 * - show_title    bool         Whether to render the title.
 * - show_excerpt  bool         Whether to render the excerpt.
 * - show_meta     bool         Whether to render the meta chip.
 * - show_cta      bool         Whether to render the details link.
 * - excerpt_length int         Word count for the excerpt.
 * - meta_key      string       Post meta key rendered as a chip.
 * - meta_label    string       Human label for the chip.
 * - price         string       Pre-formatted price line (already escaped-safe markup string is escaped).
 * - price_label   string       Label for the price line.
 * - cta_label     string       Label for the details link.
 * - class         string       Extra classes on the article.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$post          = $args['post'] ?? null;
$imageSize     = (string) ($args['image_size'] ?? 'card');
$showImage     = (bool) ($args['show_image'] ?? true);
$showTitle     = (bool) ($args['show_title'] ?? true);
$showExcerpt   = (bool) ($args['show_excerpt'] ?? true);
$showMeta      = (bool) ($args['show_meta'] ?? true);
$showCta       = (bool) ($args['show_cta'] ?? true);
$excerptLength = (int) ($args['excerpt_length'] ?? 20);
$metaKey       = (string) ($args['meta_key'] ?? '');
$metaLabel     = (string) ($args['meta_label'] ?? '');
$price         = (string) ($args['price'] ?? '');
$priceLabel    = (string) ($args['price_label'] ?? '');
$ctaLabel      = (string) ($args['cta_label'] ?? __('View details', 'wildtours-base'));
$extraClass    = (string) ($args['class'] ?? '');

$post = $post instanceof WP_Post ? $post : get_post($post);

if (! $post instanceof WP_Post) {
    return;
}

/**
 * Let plugins/child themes swap the card output entirely.
 */
$custom = apply_filters(
    'wildtours/base/card/render',
    '',
    $post,
    $args
);

if ($custom !== '') {
    echo wp_kses_post($custom); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    return;
}

$permalink  = get_permalink($post);
$metaValue  = $metaKey !== '' ? get_post_meta($post->ID, $metaKey, true) : '';
$excerpt    = wp_trim_words(
    wp_strip_all_tags((string) (get_the_excerpt($post) ?: $post->post_content)),
    max(1, $excerptLength),
    '&hellip;'
);

$classNames = implode(' ', array_filter([
    'card',
    $extraClass,
]));

/**
 * Allow child themes and plugins to append card classes.
 */
$classNames = apply_filters(
    'wildtours/base/card/classes',
    $classNames,
    $post
);

?>

<article <?php post_class($classNames, $post); ?>>

    <?php if ($showImage && has_post_thumbnail($post)) : ?>

        <a
            class="card-media"
            href="<?php echo esc_url($permalink); ?>"
            tabindex="-1"
            aria-hidden="true"
        >
            <?php
            echo get_the_post_thumbnail(
                $post,
                $imageSize,
                [
                    'loading'  => 'lazy',
                    'decoding' => 'async',
                ]
            );
            ?>
        </a>

    <?php endif; ?>

    <div class="card-body">

        <?php if ($showTitle) : ?>

            <h3 class="card-title">
                <a href="<?php echo esc_url($permalink); ?>">
                    <?php echo esc_html(get_the_title($post)); ?>
                </a>
            </h3>

        <?php endif; ?>

        <?php if ($showMeta && $metaValue !== '') : ?>

            <ul class="card-meta">
                <li class="card-chip">
                    <?php if ($metaLabel !== '') : ?>
                        <span class="card-chip-label"><?php echo esc_html($metaLabel); ?>:</span>
                    <?php endif; ?>
                    <?php echo esc_html((string) $metaValue); ?>
                </li>
            </ul>

        <?php endif; ?>

        <?php if ($showExcerpt && $excerpt !== '') : ?>

            <p class="card-excerpt"><?php echo esc_html($excerpt); ?></p>

        <?php endif; ?>

        <?php if ($price !== '') : ?>

            <p class="card-price">
                <?php if ($priceLabel !== '') : ?>
                    <span class="card-price-label"><?php echo esc_html($priceLabel); ?></span>
                <?php endif; ?>
                <span class="card-price-value"><?php echo esc_html($price); ?></span>
            </p>

        <?php endif; ?>

        <?php if ($showCta) : ?>

            <a
                class="card-cta"
                href="<?php echo esc_url($permalink); ?>"
            >
                <?php echo esc_html($ctaLabel); ?>
                <span class="screen-reader-text">: <?php echo esc_html(get_the_title($post)); ?></span>
            </a>

        <?php endif; ?>

    </div>

</article>
