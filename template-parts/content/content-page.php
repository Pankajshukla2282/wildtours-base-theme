<?php

/**
 * Page Content
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

    <?php
    get_template_part(
        'template-parts/components/page-header'
    );
    ?>

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