<?php

/**
 * Featured Image
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!has_post_thumbnail()) {
    return;
}

?>

<div class="featured-image">

    <?php

    the_post_thumbnail(
        'full',
        [
            'loading' => 'eager',
            'fetchpriority' => 'high',
        ]
    );

    ?>

</div>