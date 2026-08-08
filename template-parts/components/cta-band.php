<?php

/**
 * Call-to-action band component.
 *
 * Usage:
 *   wildtours_component( 'cta-band', [
 *       'title'    => 'Plan your safari',
 *       'text'     => 'Get a free itinerary within 24 hours.',
 *       'primary_url'   => '',
 *       'primary_label' => '',
 *       'secondary_url' => '',
 *       'secondary_label' => '',
 *       'class'    => '',
 *   ] );
 *
 * Falls back to Customizer CTA settings and then to the booking page /
 * WhatsApp number.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_title = (string) ($args['title'] ?? get_theme_mod('cta_title', ''));
$pwt_text = (string) ($args['text'] ?? get_theme_mod('cta_text', ''));
$pwt_class = isset($args['class']) ? ' ' . trim((string) $args['class']) : '';

$pwt_primary_url = (string) ($args['primary_url'] ?? get_theme_mod('cta_primary_url', ''));
$pwt_primary_label = (string) ($args['primary_label'] ?? get_theme_mod('cta_primary_label', ''));

$pwt_secondary_url = (string) ($args['secondary_url'] ?? get_theme_mod('cta_secondary_url', ''));
$pwt_secondary_label = (string) ($args['secondary_label'] ?? get_theme_mod('cta_secondary_label', ''));

if ($pwt_title === '') {
    $pwt_title = (string) apply_filters(
        'wildtours/base/cta/title',
        __('Ready for your next adventure?', 'wildtours-base')
    );
}

if ($pwt_text === '') {
    $pwt_text = (string) apply_filters(
        'wildtours/base/cta/text',
        __('Tell us your travel dates and we will craft a personalised itinerary for you.', 'wildtours-base')
    );
}

if ($pwt_primary_url === '') {
    $pwt_booking = get_posts([
        'post_type' => 'pwt_booking',
        'posts_per_page' => 1,
        'post_status' => 'any',
        'fields' => 'ids',
    ]);

    if ($pwt_booking !== []) {
        $pwt_primary_url = (string) get_permalink((int) $pwt_booking[0]);
        $pwt_primary_label = __('Book Now', 'wildtours-base');
    } elseif (wildtours_whatsapp_number() !== '') {
        $pwt_primary_url = sprintf(
            'https://wa.me/%s',
            preg_replace('/^\+/', '', wildtours_whatsapp_number())
        );
        $pwt_primary_label = __('Chat on WhatsApp', 'wildtours-base');
    }
}

if ($pwt_secondary_url === '') {
    $pwt_secondary_url = (string) get_permalink(
        (int) get_option('page_for_posts')
    );
    $pwt_secondary_label = __('Explore Packages', 'wildtours-base');
}

if ($pwt_primary_url === '' && $pwt_secondary_url === '') {
    return;
}
?>
<section class="pwt-cta-band<?php echo esc_attr($pwt_class); ?>">

    <div class="pwt-cta-band-body">

        <h2 class="pwt-cta-band-title"><?php echo esc_html($pwt_title); ?></h2>

        <?php if ($pwt_text !== '') : ?>
            <p class="pwt-cta-band-text"><?php echo esc_html($pwt_text); ?></p>
        <?php endif; ?>

    </div>

    <div class="pwt-cta-band-actions">

        <?php if ($pwt_primary_url !== '' && $pwt_primary_label !== '') : ?>
            <a
                class="pwt-btn pwt-cta-band-primary"
                href="<?php echo esc_url($pwt_primary_url); ?>"
            >
                <?php echo esc_html($pwt_primary_label); ?>
            </a>
        <?php endif; ?>

        <?php if ($pwt_secondary_url !== '' && $pwt_secondary_label !== '') : ?>
            <a
                class="pwt-btn pwt-btn-ghost pwt-cta-band-secondary"
                href="<?php echo esc_url($pwt_secondary_url); ?>"
            >
                <?php echo esc_html($pwt_secondary_label); ?>
            </a>
        <?php endif; ?>

    </div>

</section>
