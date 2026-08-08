<?php

/**
 * Pricing plans pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/pricing-plans',
    [
        'title'         => __('Pricing Plans', 'wildtours-base'),
        'description'   => __('Three pricing tiers for packages.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['pricing', 'plans', 'price', 'packages'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:group {"align":"wide"} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Choose your package</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"width":"1px","radius":"18px"}}} -->
<div class="wp-block-column" style="border-width:1px;border-radius:18px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"textAlign":"center"} -->
<h3 class="wp-block-heading has-text-align-center">Standard</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.6rem","fontWeight":"700"}}} -->
<p class="has-text-align-center" style="font-size:1.6rem;font-weight:700">₹14,999</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">per person</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Choose Standard</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"width":"1px","radius":"18px"}},"backgroundColor":"primary-dark"} -->
<div class="wp-block-column has-primary-dark-background-color has-background" style="border-width:1px;border-radius:18px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"textAlign":"center","textColor":"white"} -->
<h3 class="wp-block-heading has-text-align-center has-white-color has-text-color">Premium</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"accent","style":{"typography":{"fontSize":"1.6rem","fontWeight":"700"}}} -->
<p class="has-text-align-center has-accent-color has-text-color" style="font-size:1.6rem;font-weight:700">₹24,999</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color">per person</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-background wp-element-button" style="background-color:#D97706" href="#">Choose Premium</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"width":"1px","radius":"18px"}}} -->
<div class="wp-block-column" style="border-width:1px;border-radius:18px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"textAlign":"center"} -->
<h3 class="wp-block-heading has-text-align-center">Luxury</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.6rem","fontWeight":"700"}}} -->
<p class="has-text-align-center" style="font-size:1.6rem;font-weight:700">₹39,999</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">per person</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Choose Luxury</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
    ]
);
