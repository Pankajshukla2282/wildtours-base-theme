<?php

/**
 * Archive Template
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
            get_template_part(
                'template-parts/archive/header'
            );
            ?>

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