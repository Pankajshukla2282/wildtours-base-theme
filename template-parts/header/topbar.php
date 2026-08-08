<?php

/**
 * Header Top Bar
 *
 * Optional utility bar above the main navigation. Controlled by the
 * Customizer (Top Bar Text, Header CTA) plus the currency switcher.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_topbar_text = (string) get_theme_mod('topbar_text', '');
$pwt_cta_label = (string) get_theme_mod('header_cta_label', '');
$pwt_cta_url = (string) get_theme_mod('header_cta_url', '');

$pwt_has_utility = $pwt_topbar_text !== ''
    || $pwt_cta_label !== '';
?>
<?php if ($pwt_has_utility) : ?>

    <div class="topbar">

        <?php if ($pwt_topbar_text !== '') : ?>
            <p class="topbar-text"><?php echo esc_html($pwt_topbar_text); ?></p>
        <?php endif; ?>

        <div class="topbar-utility">

            <?php wildtours_component('language-switcher'); ?>

            <?php if ($pwt_cta_label !== '' && $pwt_cta_url !== '') : ?>
                <a
                    class="pwt-btn topbar-cta"
                    href="<?php echo esc_url($pwt_cta_url); ?>"
                >
                    <?php echo esc_html($pwt_cta_label); ?>
                </a>
            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>
