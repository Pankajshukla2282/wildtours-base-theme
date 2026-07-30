<?php

/**
 * Single Post Content
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<article
    id="post-<?php the_ID(); ?>"
    <?php post_class('entry'); ?>
>

    <?php get_template_part('template-parts/components/featured-image'); ?>

    <header class="entry-header">

        <?php
        the_title(
            '<h1 class="entry-title">',
            '</h1>'
        );
        ?>

        <?php
        get_template_part(
            'template-parts/components/entry-meta'
        );
        ?>

    </header>

    <div class="entry-content">

        <?php

        the_content();

        wp_link_pages([
            'before' => '<nav class="page-links">',
            'after'  => '</nav>',
        ]);

        ?>

    </div>

    <footer class="entry-footer">

        <?php
        get_template_part(
            'template-parts/components/entry-footer'
        );
        ?>

    </footer>

</article>

<?php

if (comments_open() || get_comments_number()) {
    comments_template();
}