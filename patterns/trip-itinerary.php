<?php

/**
 * Trip itinerary pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/trip-itinerary',
    [
        'title'         => __('Trip Itinerary', 'wildtours-base'),
        'description'   => __('A day-by-day itinerary layout with numbered days.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['itinerary', 'days', 'trip', 'schedule'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:group {"align":"wide"} -->
<div class="wp-block-group alignwide"><!-- wp:heading -->
<h2 class="wp-block-heading">Your Itinerary</h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"width":"1px","radius":"16px"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Day 1</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Arrival and check-in at your jungle lodge, evening nature walk.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"width":"1px","radius":"16px"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Day 2</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Morning and evening jeep safaris in the core zone.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"width":"1px","radius":"16px"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Day 3</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Departure with a wildlife photography session at dawn.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
    ]
);
