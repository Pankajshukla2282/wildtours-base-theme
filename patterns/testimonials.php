<?php

/**
 * Testimonials pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/testimonials',
    [
        'title'         => __('Testimonials', 'wildtours-base'),
        'description'   => __('Three customer testimonials with star ratings.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['testimonials', 'reviews', 'quotes', 'social proof'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:group {"align":"wide"} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">What travellers say</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"accent","style":{"typography":{"fontSize":"1.1rem"}}} -->
<p class="has-accent-color has-text-color" style="font-size:1.1rem">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>"An unforgettable safari. The team handled everything perfectly."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} -->
<p style="font-weight:700">Rahul M.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"accent","style":{"typography":{"fontSize":"1.1rem"}}} -->
<p class="has-accent-color has-text-color" style="font-size:1.1rem">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>"Beautiful lodges and expert naturalists. Highly recommended."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} -->
<p style="font-weight:700">Sophie W.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"accent","style":{"typography":{"fontSize":"1.1rem"}}} -->
<p class="has-accent-color has-text-color" style="font-size:1.1rem">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>"The best price and the best guide. Worth every rupee."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} -->
<p style="font-weight:700">Anika S.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
    ]
);
