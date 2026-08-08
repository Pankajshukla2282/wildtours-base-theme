<?php

/**
 * Trust badges strip component.
 *
 * Usage:
 *   wildtours_component( 'trust-badges', [
 *       'items' => [
 *           [ 'icon' => 'shield', 'label' => 'Verified & licensed' ],
 *           [ 'icon' => 'users',  'label' => 'Best price guarantee' ],
 *       ],
 *   ] );
 *
 * Icons: shield | users | calendar | wallet | star | leaf.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_defaults = [
    ['icon' => 'shield', 'label' => __('Licensed & insured operators', 'wildtours-base')],
    ['icon' => 'wallet', 'label' => __('Best price guarantee', 'wildtours-base')],
    ['icon' => 'calendar', 'label' => __('Flexible cancellations', 'wildtours-base')],
    ['icon' => 'users', 'label' => __('Expert local guides', 'wildtours-base')],
];

$pwt_items = isset($args['items']) && is_array($args['items'])
    ? $args['items']
    : $pwt_defaults;

$pwt_items = (array) apply_filters(
    'wildtours/base/badges/items',
    $pwt_items
);

if ($pwt_items === []) {
    return;
}

$pwt_icons = [
    'shield' => 'M12 2 4 5v6c0 5.25 3.4 9.74 8 11 4.6-1.26 8-5.75 8-11V5l-8-3z',
    'users' => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75',
    'calendar' => 'M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z',
    'wallet' => 'M21 12V7H5a2 2 0 0 1 0-4h14v4M3 5v14a2 2 0 0 0 2 2h16v-5M18 12a2 2 0 0 0 0 4h4v-4h-4z',
    'star' => 'm12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z',
    'leaf' => 'M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10zM2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12',
];
?>
<ul class="pwt-badges">

    <?php foreach ($pwt_items as $pwt_item) : ?>

        <?php
        $pwt_icon = (string) ($pwt_item['icon'] ?? 'shield');
        $pwt_label = (string) ($pwt_item['label'] ?? '');
        $pwt_path = $pwt_icons[$pwt_icon] ?? $pwt_icons['shield'];

        if ($pwt_label === '') {
            continue;
        }
        ?>

        <li class="pwt-badge">
            <svg class="pwt-badge-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="<?php echo esc_attr($pwt_path); ?>" />
            </svg>
            <span><?php echo esc_html($pwt_label); ?></span>
        </li>

    <?php endforeach; ?>

</ul>
