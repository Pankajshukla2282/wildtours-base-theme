<?php

/**
 * Search Results Template
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

            <?php
            do_action(
                'wildtours/base/before_search'
            );

            get_template_part(
                'template-parts/search/header'
            );
            ?>

            <?php while (have_posts()) : ?>

                <?php
                the_post();

                get_template_part(
                    'template-parts/content/content',
                    get_post_type()
                );
                ?>

            <?php endwhile; ?>

            <?php
            do_action(
                'wildtours/base/after_search'
            );

            get_template_part(
                'template-parts/navigation/posts'
            );
            ?>

        <?php else : ?>

            <?php
            get_template_part(
                'template-parts/content/content',
                'none'
            );
            ?>

        <?php endif; ?>

    </main>

</div>

<?php

get_footer();