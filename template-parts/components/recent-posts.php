<?php

/**
 * Recent Posts Component
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$query = new WP_Query([
    'posts_per_page' => 5,
    'no_found_rows'  => true,
]);

if (!$query->have_posts()) {
    return;
}

?>

<section class="recent-posts">

    <h2>

        <?php
        esc_html_e(
            'Recent Posts',
            'wildtours-base'
        );
        ?>

    </h2>

    <ul>

        <?php while ($query->have_posts()) : ?>

            <?php $query->the_post(); ?>

            <li>

                <a href="<?php the_permalink(); ?>">

                    <?php the_title(); ?>

                </a>

            </li>

        <?php endwhile; ?>

    </ul>

</section>

<?php

wp_reset_postdata();