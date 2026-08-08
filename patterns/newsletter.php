<?php

/**
 * Newsletter pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/newsletter',
    [
        'title'         => __('Newsletter Signup', 'wildtours-base'),
        'description'   => __('A newsletter signup band for deals and safari tips.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['newsletter', 'subscribe', 'email', 'deals'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:group {"align":"full","backgroundColor":"surface-alt","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-alt-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Get travel deals</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>One email a month with seasonal offers and safari tips. No spam.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><em>[Insert your newsletter form here]</em></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
    ]
);
