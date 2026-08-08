<?php

/**
 * CTA band pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/cta-band',
    [
        'title'         => __('Call to Action Band', 'wildtours-base'),
        'description'   => __('A full-width call to action with headline and two buttons.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['cta', 'band', 'booking', 'travel'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:group {"align":"full","backgroundColor":"primary-dark","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"textColor":"white","fontSize":"x-large"} -->
<h2 class="wp-block-heading has-white-color has-text-color has-x-large-font-size">Ready for your next adventure?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"white"} -->
<p class="has-white-color has-text-color">Tell us your travel dates and we will craft a personalised safari itinerary for you.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"flex-end"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"white","textColor":"primary-dark"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-dark-color has-white-background-color has-text-color has-background wp-element-button" href="#">Book Now</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","backgroundColor":"transparent","textColor":"white"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-white-color has-transparent-background-color has-text-color has-background wp-element-button" href="#">Explore Packages</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
    ]
);
