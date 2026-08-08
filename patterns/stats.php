<?php

/**
 * Stats pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/stats',
    [
        'title'         => __('Stats / Counters', 'wildtours-base'),
        'description'   => __('Four statistics in a row with a section heading.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['stats', 'counters', 'numbers', 'achievements'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:group {"align":"full","backgroundColor":"surface-alt","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-alt-background-color has-background"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Why travellers choose us</h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"textAlign":"center","textColor":"primary","fontSize":"x-large"} -->
<h2 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-x-large-font-size">12+</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Years of experience</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"textAlign":"center","textColor":"primary","fontSize":"x-large"} -->
<h2 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-x-large-font-size">4500+</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Happy travellers</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"textAlign":"center","textColor":"primary","fontSize":"x-large"} -->
<h2 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-x-large-font-size">90+</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Custom safaris planned</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"textAlign":"center","textColor":"primary","fontSize":"x-large"} -->
<h2 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-x-large-font-size">4.9</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Average rating</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
    ]
);
