<?php

/**
 * Entry meta.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<div class="entry-meta">

    <span class="posted-on">
        <?php echo esc_html(get_the_date()); ?>
    </span>

    <span class="byline">
        <?php the_author_posts_link(); ?>
    </span>

    <?php
    /**
     * Allow child themes and plugins
     * to append metadata.
     */
    do_action(
        'wildtours/base/entry_meta'
    );
    ?>

</div>