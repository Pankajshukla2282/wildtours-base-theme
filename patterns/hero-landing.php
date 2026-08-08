<?php

/**
 * Hero landing pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/hero-landing',
    [
        'title'         => __('Hero Landing', 'wildtours-base'),
        'description'   => __('Full-width hero with a headline, supporting text and buttons.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['hero', 'landing', 'cover', 'homepage'],
        'viewportWidth' => 1440,
        'content'       => '<!-- wp:cover {"dimRatio":55,"overlayColor":"primary-dark","minHeight":560,"align":"full","contentPosition":"center left","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50);min-height:560px"><span aria-hidden="true" class="wp-block-cover__background has-primary-dark-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"textColor":"accent","fontSize":"small"} -->
<p class="has-accent-color has-text-color has-small-font-size">WILDLIFE &amp; JUNGLE ADVENTURES</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textColor":"white","fontSize":"hero"} -->
<h2 class="wp-block-heading has-white-color has-text-color has-hero-font-size">Explore the Heart of the Wild</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"white"} -->
<p class="has-white-color has-text-color">Premium jeep safaris, handpicked lodges and unforgettable itineraries across India&#8217;s finest national parks.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"white"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-accent-background-color has-text-color has-background wp-element-button" href="#">Explore Safaris</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","textColor":"white"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-white-color has-text-color wp-element-button" href="#">Plan My Trip</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->',
    ]
);
