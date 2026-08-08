<?php

/**
 * Gallery grid pattern.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('register_block_pattern')) {
    return;
}

register_block_pattern(
    'wildtours/gallery-grid',
    [
        'title'         => __('Gallery Grid', 'wildtours-base'),
        'description'   => __('A responsive six-image travel gallery grid.', 'wildtours-base'),
        'categories'    => ['wildtours'],
        'keywords'      => ['gallery', 'images', 'photos', 'grid'],
        'viewportWidth' => 1280,
        'content'       => '<!-- wp:gallery {"columns":3,"linkTo":"none"} -->
<figure class="wp-block-gallery has-nested-images columns-3 is-cropped"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="" /></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="" /></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="" /></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="" /></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="" /></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="" alt="" /></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery -->',
    ]
);
