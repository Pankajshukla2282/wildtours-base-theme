<?php

/**
 * Default content template.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<article
    id="post-<?php the_ID(); ?>"
    <?php post_class(); ?>
>

    <header class="entry-header">

        <?php

        if (is_singular()) {

            the_title('<h1 class="entry-title">', '</h1>');

        } else {

            the_title(
                sprintf(
                    '<h2 class="entry-title"><a href="%s" rel="bookmark">',
                    esc_url(get_permalink())
                ),
                '</a></h2>'
            );

        }

        ?>

    </header>

    <div class="entry-content">

        <?php

        if (is_singular()) {
            the_content();

            wp_link_pages([
                'before' => '<nav class="page-links">',
                'after'  => '</nav>',
            ]);
        } else {
            the_excerpt();
        }

        ?>

    </div>

</article>