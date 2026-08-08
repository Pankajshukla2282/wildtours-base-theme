<?php

/**
 * Page Content (No Title).
 *
 * Renders page content only, skipping the title header.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<article
    id="post-<?php the_ID(); ?>"
    <?php post_class('page'); ?>
>

    <div class="entry-content">

        <?php
        the_content();

        wp_link_pages([
            'before' => '<nav class="page-links">',
            'after'  => '</nav>',
        ]);
        ?>

    </div>

    <?php
    get_template_part(
        'template-parts/components/page-footer'
    );
    ?>

</article>
