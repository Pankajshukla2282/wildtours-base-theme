<?php

/**
 * Social links component.
 *
 * Reads Customizer social options (social_facebook, social_instagram, ...)
 * unless $items is provided explicitly.
 *
 * Usage:
 *   wildtours_component( 'social-links', [
 *       'items' => [ 'facebook' => 'https://...', 'instagram' => 'https://...' ],
 *       'class' => '',
 *   ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_items = isset($args['items']) && is_array($args['items'])
    ? $args['items']
    : [];

if ($pwt_items === []) {

    $pwt_networks = [
        'facebook' => __('Facebook', 'wildtours-base'),
        'instagram' => __('Instagram', 'wildtours-base'),
        'youtube' => __('YouTube', 'wildtours-base'),
        'twitter' => __('Twitter / X', 'wildtours-base'),
        'linkedin' => __('LinkedIn', 'wildtours-base'),
    ];

    foreach (array_keys($pwt_networks) as $pwt_network) {
        $pwt_url = (string) get_theme_mod("social_{$pwt_network}", '');

        if ($pwt_url !== '') {
            $pwt_items[$pwt_network] = $pwt_url;
        }
    }
}

$pwt_items = (array) apply_filters(
    'wildtours/base/social/links',
    $pwt_items
);

if ($pwt_items === []) {
    return;
}

$pwt_class = isset($args['class']) ? ' ' . trim((string) $args['class']) : '';
?>
<ul class="pwt-social-links<?php echo esc_attr($pwt_class); ?>">

    <?php foreach ($pwt_items as $pwt_network => $pwt_url) : ?>

        <?php if (is_int($pwt_network)) {
            $pwt_network = (string) ($pwt_url['network'] ?? 'link');
            $pwt_url = (string) ($pwt_url['url'] ?? '');
        }

        if ($pwt_url === '') {
            continue;
        }
        ?>

        <li>
            <a
                class="pwt-social-link pwt-social-<?php echo esc_attr(sanitize_html_class($pwt_network)); ?>"
                href="<?php echo esc_url($pwt_url); ?>"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="<?php echo esc_attr(sprintf(
                    /* translators: %s: network name. */
                    __('Visit us on %s', 'wildtours-base'),
                    ucfirst((string) $pwt_network)
                )); ?>"
            >
                <?php
                $pwt_label = match ($pwt_network) {
                    'facebook' => 'f',
                    'instagram' => 'Ig',
                    'youtube' => 'Yt',
                    'twitter', 'x' => 'X',
                    'linkedin' => 'in',
                    default => ucfirst((string) $pwt_network),
                };
                ?>

                <span aria-hidden="true"><?php echo esc_html($pwt_label); ?></span>
            </a>
        </li>

    <?php endforeach; ?>

</ul>
