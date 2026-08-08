<?php

/**
 * Template for displaying single posts.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

get_header();

$hasSidebar = wildtours_show_sidebar();
?>

<div class="content-area<?php echo $hasSidebar ? ' content-area--with-sidebar' : ''; ?>">

    <main
        id="primary"
        class="site-main"
    >

        <?php
        while (have_posts()) :

            the_post();

            get_template_part(
                'template-parts/content/content',
                get_post_type()
            );

        endwhile;
        ?>

    </main>

    <?php if ($hasSidebar) : ?>

        <?php get_sidebar(); ?>

    <?php endif; ?>

</div>

<?php
get_footer();