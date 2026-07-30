<?php

/**
 * Blog posts index.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

get_header();
?>

<div class="content-area">

    <main
        id="primary"
        class="site-main"
    >

        <?php if (have_posts()) : ?>

            <header class="page-header">

                <?php
                if (is_home() && !is_front_page()) :
                ?>

                    <h1 class="page-title">
                        <?php single_post_title(); ?>
                    </h1>

                <?php else : ?>

                    <h1 class="page-title">
                        <?php bloginfo('name'); ?>
                    </h1>

                <?php endif; ?>

            </header>

            <?php

            while (have_posts()) :

                the_post();

                get_template_part(
                    'template-parts/content/content',
                    get_post_type()
                );

            endwhile;

            get_template_part(
                'template-parts/navigation/posts'
            );

        else :

            get_template_part(
                'template-parts/content/content',
                'none'
            );

        endif;

        ?>

    </main>

</div>

<?php

get_footer();