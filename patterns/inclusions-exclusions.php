<?php

/**
 * Inclusions / Exclusions pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/inclusions-exclusions',
    [
        'title'         => __('Inclusions & Exclusions', 'wildtours-base'),
        'description'   => __('Two-column checklist comparing what is included and excluded.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['inclusions', 'exclusions', 'checklist', 'itinerary'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"16px"}},"backgroundColor":"surface"} -->
<div class="wp-block-column has-surface-background-color has-background" style="border-radius:16px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">What&#8217;s Included</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><!-- wp:list-item -->
<li>Accommodation on double sharing</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>All safaris with naturalist guides</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Meals as per itinerary</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>All park permits and fees</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"16px"}},"backgroundColor":"surface-alt"} -->
<div class="wp-block-column has-surface-alt-background-color has-background" style="border-radius:16px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Not Included</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><!-- wp:list-item -->
<li>Flights and transfers</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Travel insurance</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Gratuities and tips</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Personal expenses</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
    ]
);
