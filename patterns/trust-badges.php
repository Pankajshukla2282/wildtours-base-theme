<?php

/**
 * Trust badges pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/trust-badges',
    [
        'title'         => __('Trust Badges', 'wildtours-base'),
        'description'   => __('A row of trust signals ideal above or below a booking form.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['trust', 'badges', 'guarantee', 'assurance'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"backgroundColor":"surface","textColor":"ink"} -->
<p class="has-ink-color has-surface-background-color has-text-color has-background" style="font-weight:600">Licensed &amp; insured operators</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"backgroundColor":"surface","textColor":"ink"} -->
<p class="has-ink-color has-surface-background-color has-text-color has-background" style="font-weight:600">Best price guarantee</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"backgroundColor":"surface","textColor":"ink"} -->
<p class="has-ink-color has-surface-background-color has-text-color has-background" style="font-weight:600">Flexible cancellations</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"backgroundColor":"surface","textColor":"ink"} -->
<p class="has-ink-color has-surface-background-color has-text-color has-background" style="font-weight:600">Expert local guides</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
    ]
);
