<?php

/**
 * Contact highlight pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/contact-highlight',
    [
        'title'         => __('Contact Highlight', 'wildtours-base'),
        'description'   => __('Contact details band with phone, email and a WhatsApp button.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['contact', 'phone', 'email', 'whatsapp', 'reach'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:group {"align":"wide","backgroundColor":"primary","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"20px"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide has-primary-background-color has-background" style="border-radius:20px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="wp-block-heading has-white-color has-text-color">Planning a trip? Talk to us.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"white"} -->
<p class="has-white-color has-text-color">+91 98765 43210 &nbsp;·&nbsp; hello@example.com</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"white","textColor":"primary-dark"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-dark-color has-white-background-color has-text-color has-background wp-element-button" href="#">WhatsApp Us</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
    ]
);
