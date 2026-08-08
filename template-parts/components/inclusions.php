<?php

/**
 * Inclusions / Exclusions list component.
 *
 * Usage:
 *   wildtours_component( 'inclusions', [
 *       'post'  => get_the_ID(),
 *       'field' => 'inclusions',
 *   ] );
 *
 *   wildtours_component( 'exclusions', [
 *       'items' => [ 'Travel insurance', 'Tips' ],
 *   ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_type = str_ends_with(basename(__FILE__), 'exclusions.php')
    ? 'exclusions'
    : 'inclusions';

$pwt_items = [];

if (!empty($args['items']) && is_array($args['items'])) {
    $pwt_items = $args['items'];
} else {
    $pwt_post = isset($args['post']) ? (int) $args['post'] : get_the_ID();
    $pwt_field = isset($args['field']) ? (string) $args['field'] : $pwt_type;
    $pwt_value = wildtours_field($pwt_post, $pwt_field);

    if (is_array($pwt_value)) {
        $pwt_items = $pwt_value;
    } elseif (is_string($pwt_value) && $pwt_value !== '') {
        $pwt_items = wildtours_lines_to_items($pwt_value);
    }
}

$pwt_items = (array) apply_filters(
    "wildtours/base/{$pwt_type}/items",
    $pwt_items
);

if ($pwt_items === []) {
    return;
}
?>
<div class="pwt-<?php echo esc_attr($pwt_type); ?>">
    <h3 class="pwt-<?php echo esc_attr($pwt_type); ?>-title">
        <?php
        echo esc_html(
            $pwt_type === 'inclusions'
                ? __('What\'s Included', 'wildtours-base')
                : __('Not Included', 'wildtours-base')
        );
        ?>
    </h3>

    <ul class="pwt-<?php echo esc_attr($pwt_type); ?>-list">

        <?php foreach ($pwt_items as $pwt_item) : ?>

            <?php
            if (is_array($pwt_item)) {
                $pwt_item = (string) ($pwt_item['label'] ?? $pwt_item['value'] ?? '');
            }

            $pwt_item = (string) $pwt_item;

            if ($pwt_item === '') {
                continue;
            }
            ?>

            <li>
                <svg
                    class="pwt-<?php echo esc_attr($pwt_type); ?>-icon"
                    viewBox="0 0 24 24"
                    width="18"
                    height="18"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <?php if ($pwt_type === 'inclusions') : ?>
                        <path d="M20 6 9 17l-5-5" />
                    <?php else : ?>
                        <path d="M18 6 6 18M6 6l12 12" />
                    <?php endif; ?>
                </svg>

                <span><?php echo esc_html($pwt_item); ?></span>
            </li>

        <?php endforeach; ?>

    </ul>
</div>
