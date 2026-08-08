<?php

/**
 * Footer Site Info
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_copyright = (string) get_theme_mod('footer_copyright', '');

if ($pwt_copyright === '') {
    $pwt_copyright = sprintf(
        /* translators: 1: year, 2: site name. */
        __('© %1$s %2$s', 'wildtours-base'),
        wp_date('Y'),
        get_bloginfo('name')
    );
}

$pwt_copyright = (string) apply_filters(
    'wildtours/base/footer_copyright',
    $pwt_copyright
);
?>

<div class="site-info">

    <p>
        <?php echo wp_kses_post($pwt_copyright); ?>
    </p>

    <?php wildtours_component('social-links', ['class' => 'site-info-social']); ?>

</div>