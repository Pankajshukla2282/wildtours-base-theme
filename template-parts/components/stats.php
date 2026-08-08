<?php

/**
 * Stats / counters component.
 *
 * Usage:
 *   wildtours_component( 'stats', [
 *       'title' => 'Why choose us',
 *       'items' => [
 *           [ 'value' => 12, 'suffix' => '+', 'label' => 'Years of experience' ],
 *           [ 'value' => 4500, 'suffix' => '+', 'label' => 'Happy travellers' ],
 *       ],
 *   ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_items = isset($args['items']) && is_array($args['items'])
    ? $args['items']
    : [];

$pwt_items = (array) apply_filters(
    'wildtours/base/stats/items',
    $pwt_items
);

if ($pwt_items === []) {
    return;
}
?>
<section class="pwt-stats">

    <?php if (!empty($args['title'])) : ?>
        <h2 class="pwt-stats-title"><?php echo esc_html((string) $args['title']); ?></h2>
    <?php endif; ?>

    <div class="pwt-stats-grid">

        <?php foreach ($pwt_items as $pwt_item) : ?>

            <?php
            $pwt_value = (float) ($pwt_item['value'] ?? 0);
            $pwt_suffix = (string) ($pwt_item['suffix'] ?? '');
            $pwt_label = (string) ($pwt_item['label'] ?? '');
            ?>

            <div class="pwt-stat">
                <span class="pwt-stat-value">
                    <span
                        class="pwt-stat-counter"
                        data-target="<?php echo esc_attr((string) $pwt_value); ?>"
                        data-decimals="<?php echo esc_attr((string) (int) ($pwt_item['decimals'] ?? 0)); ?>"
                    >
                        0
                    </span><?php echo esc_html($pwt_suffix); ?>
                </span>

                <?php if ($pwt_label !== '') : ?>
                    <span class="pwt-stat-label"><?php echo esc_html($pwt_label); ?></span>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>

    </div>

</section>
