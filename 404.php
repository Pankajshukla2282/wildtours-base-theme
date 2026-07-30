<?php

/**
 * The template for displaying 404 pages.
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
        class="site-main error-404"
    >

        <?php
        do_action('wildtours/base/before_404');
        ?>

        <section class="page-content">

            <header class="page-header">

                <h1 class="page-title">

                    <?php
                    esc_html_e(
                        'Page Not Found',
                        'wildtours-base'
                    );
                    ?>

                </h1>

            </header>

            <div class="page-content">

                <p>

                    <?php

                    esc_html_e(
                        'The page you requested could not be found. Try searching or browse our latest content.',
                        'wildtours-base'
                    );

                    ?>

                </p>

                <?php get_search_form(); ?>

                <?php
                get_template_part(
                    'template-parts/components/recent-posts'
                );
                ?>

            </div>

        </section>

        <?php
        do_action('wildtours/base/after_404');
        ?>

    </main>

</div>

<?php

get_footer();