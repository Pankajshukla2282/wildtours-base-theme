<?php

/**
 * Pricing table component for safari/package posts.
 *
 * Usage:
 *   wildtours_component( 'pricing-table', [
 *       'post' => get_the_ID(),
 *   ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_post = isset($args['post']) ? (int) $args['post'] : get_the_ID();

$pwt_regular = (float) wildtours_field($pwt_post, 'regular_price');
$pwt_offer = (float) wildtours_field($pwt_post, 'offer_price');
$pwt_child = (float) wildtours_field($pwt_post, 'child_price');
$pwt_minimum = (int) wildtours_field($pwt_post, 'minimum_person', 1);
$pwt_maximum = (int) wildtours_field($pwt_post, 'maximum_person', 0);

$pwt_seasons = [
    'peak' => (float) wildtours_field($pwt_post, 'peak_multiplier', 1.2),
    'shoulder' => (float) wildtours_field($pwt_post, 'shoulder_multiplier', 1),
    'monsoon' => (float) wildtours_field($pwt_post, 'monsoon_multiplier', 0.85),
];

$pwt_has_price = $pwt_regular > 0 || $pwt_offer > 0;

if (!$pwt_has_price) {
    return;
}
?>
<div class="pwt-pricing">

    <div class="pwt-pricing-card">

        <?php if ($pwt_offer > 0 && $pwt_offer < $pwt_regular) : ?>

            <p class="pwt-pricing-label">
                <?php esc_html_e('Special Offer', 'wildtours-base'); ?>
            </p>

            <p class="pwt-pricing-price">
                <?php echo esc_html(wildtours_price($pwt_offer)); ?>
                <?php if ($pwt_regular > 0) : ?>
                    <del class="pwt-pricing-regular">
                        <?php echo esc_html(wildtours_price($pwt_regular)); ?>
                    </del>
                <?php endif; ?>
            </p>

        <?php elseif ($pwt_regular > 0) : ?>

            <p class="pwt-pricing-label">
                <?php esc_html_e('From', 'wildtours-base'); ?>
            </p>

            <p class="pwt-pricing-price">
                <?php echo esc_html(wildtours_price($pwt_regular)); ?>
            </p>

        <?php endif; ?>

        <?php if ($pwt_child > 0) : ?>
            <p class="pwt-pricing-note">
                <?php
                printf(
                    /* translators: %s: formatted child price. */
                    esc_html__('Child (below 12 years): %s', 'wildtours-base'),
                    esc_html(wildtours_price($pwt_child))
                );
                ?>
            </p>
        <?php endif; ?>

        <?php if ($pwt_minimum > 1 || $pwt_maximum > 0) : ?>
            <p class="pwt-pricing-note">
                <?php
                if ($pwt_maximum > 0) {
                    printf(
                        /* translators: 1: minimum persons, 2: maximum persons. */
                        esc_html__('%1$d to %2$d persons per group', 'wildtours-base'),
                        $pwt_minimum,
                        $pwt_maximum
                    );
                } else {
                    printf(
                        /* translators: %d: minimum persons. */
                        esc_html__('Minimum %d persons', 'wildtours-base'),
                        $pwt_minimum
                    );
                }
                ?>
            </p>
        <?php endif; ?>

        <p class="pwt-pricing-footnote">
            <?php esc_html_e('Prices are per person and subject to seasonal variance.', 'wildtours-base'); ?>
        </p>

    </div>

    <?php if (array_filter($pwt_seasons, static fn (float $m): bool => $m !== 1.0) !== []) : ?>

        <table class="pwt-pricing-seasons">

            <caption class="pwt-pricing-seasons-title">
                <?php esc_html_e('Seasonal Pricing', 'wildtours-base'); ?>
            </caption>

            <thead>
                <tr>
                    <th scope="col"><?php esc_html_e('Season', 'wildtours-base'); ?></th>
                    <th scope="col"><?php esc_html_e('Multiplier', 'wildtours-base'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($pwt_seasons as $pwt_season => $pwt_multiplier) : ?>

                    <?php
                    $pwt_season_label = match ($pwt_season) {
                        'peak' => __('Peak (Oct - Jun)', 'wildtours-base'),
                        'shoulder' => __('Shoulder', 'wildtours-base'),
                        'monsoon' => __('Monsoon (Jul - Sep)', 'wildtours-base'),
                        default => $pwt_season,
                    };
                    ?>

                    <tr>
                        <td><?php echo esc_html($pwt_season_label); ?></td>
                        <td>
                            <?php
                            printf(
                                '&times; %s',
                                esc_html(number_format_i18n($pwt_multiplier, 2))
                            );
                            ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>

        </table>

    <?php endif; ?>

</div>
