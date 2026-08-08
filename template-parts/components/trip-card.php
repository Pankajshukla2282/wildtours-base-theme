<?php

/**
 * Trip card — package/safari listing card with meta + price.
 *
 * Wraps the generic card component with post-meta aware data.
 *
 * Usage:
 *   wildtours_component( 'trip-card', [
 *       'post'         => get_the_ID(),
 *       'show_meta'    => true,
 *       'show_price'   => true,
 *       'meta'         => [ 'duration', 'days' ],   // custom meta keys.
 *   ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_post = isset($args['post']) ? (int) $args['post'] : get_the_ID();

if ($pwt_post < 1) {
    return;
}

$pwt_show_meta = !isset($args['show_meta']) || (bool) $args['show_meta'];
$pwt_show_price = !isset($args['show_price']) || (bool) $args['show_price'];

$pwt_meta = [];

if ($pwt_show_meta) {

    $pwt_meta_keys = isset($args['meta']) && is_array($args['meta'])
        ? $args['meta']
        : ['duration', 'days', 'nights', 'shift', 'safari_type'];

    foreach ($pwt_meta_keys as $pwt_key) {
        $pwt_value = wildtours_field($pwt_post, (string) $pwt_key);

        if (is_string($pwt_value) && $pwt_value !== '') {
            $pwt_meta[(string) $pwt_key] = $pwt_value;
        }
    }
}

$pwt_card_args = [
    'post' => $pwt_post,
    'image_size' => $args['image_size'] ?? 'card',
    'class' => $args['class'] ?? '',
    'show_excerpt' => $args['show_excerpt'] ?? true,
    'excerpt_length' => $args['excerpt_length'] ?? 20,
];

if ($pwt_meta !== []) {
    $pwt_card_args['meta'] = $pwt_meta;
    $pwt_card_args['show_meta'] = true;
}

if ($pwt_show_price) {

    $pwt_offer = (float) wildtours_field($pwt_post, 'offer_price');
    $pwt_regular = (float) wildtours_field($pwt_post, 'regular_price');
    $pwt_price = $pwt_offer > 0 ? $pwt_offer : $pwt_regular;

    if ($pwt_price > 0) {
        $pwt_card_args['price'] = wildtours_price($pwt_price);
        $pwt_card_args['price_label'] = $pwt_offer > 0
            ? __('Special Offer', 'wildtours-base')
            : __('From', 'wildtours-base');
        $pwt_card_args['show_price'] = true;
    }
}

wildtours_component('card', $pwt_card_args);
