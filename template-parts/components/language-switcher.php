<?php

/**
 * Language switcher component.
 *
 * Renders only when a translation plugin (WPML / Polylang / TranslatePress)
 * exposes languages through the wildtours/base/languages filter. The base
 * theme ships without one so the component stays silent by default.
 *
 * Usage:
 *   wildtours_component( 'language-switcher' );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_languages = (array) apply_filters(
    'wildtours/base/languages',
    []
);

if (count($pwt_languages) < 2) {
    return;
}
?>
<nav class="pwt-language-switcher" aria-label="<?php esc_attr_e('Language switcher', 'wildtours-base'); ?>">

    <?php foreach ($pwt_languages as $pwt_language) : ?>

        <?php
        $pwt_label = (string) ($pwt_language['label'] ?? '');
        $pwt_url = (string) ($pwt_language['url'] ?? '');
        $pwt_active = !empty($pwt_language['active']);

        if ($pwt_label === '' || $pwt_url === '') {
            continue;
        }
        ?>

        <?php if ($pwt_active) : ?>
            <span class="pwt-language pwt-language-active" aria-current="true">
                <?php echo esc_html($pwt_label); ?>
            </span>
        <?php else : ?>
            <a class="pwt-language" href="<?php echo esc_url($pwt_url); ?>">
                <?php echo esc_html($pwt_label); ?>
            </a>
        <?php endif; ?>

    <?php endforeach; ?>

</nav>
