<?php

/**
 * Testimonials component.
 *
 * Usage:
 *   wildtours_component( 'testimonials', [
 *       'items' => [
 *           [ 'name' => 'John', 'role' => 'Traveller', 'rating' => 5,
 *             'content' => 'Amazing trip!', 'avatar' => 42 ],
 *       ],
 *   ] );
 *
 * Without $items it pulls the latest pwt_testimonial posts when the
 * companion plugin is active.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_items = isset($args['items']) && is_array($args['items'])
    ? $args['items']
    : [];

if ($pwt_items === [] && post_type_exists('pwt_testimonial')) {

    $pwt_query = new WP_Query([
        'post_type' => 'pwt_testimonial',
        'posts_per_page' => isset($args['limit']) ? (int) $args['limit'] : 6,
        'post_status' => 'publish',
        'no_found_rows' => true,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);

    foreach ($pwt_query->posts as $pwt_testimonial) {
        $pwt_items[] = [
            'name' => get_the_title($pwt_testimonial),
            'role' => (string) wildtours_field($pwt_testimonial->ID, 'guest_from', ''),
            'rating' => (int) wildtours_field($pwt_testimonial->ID, 'rating', 5),
            'content' => get_the_excerpt($pwt_testimonial),
            'avatar' => (int) get_post_thumbnail_id($pwt_testimonial),
        ];
    }

    wp_reset_postdata();
}

$pwt_items = (array) apply_filters(
    'wildtours/base/testimonials/items',
    $pwt_items
);

if ($pwt_items === []) {
    return;
}
?>
<section class="pwt-testimonials">

    <?php if (!empty($args['title'])) : ?>
        <h2 class="pwt-testimonials-title"><?php echo esc_html((string) $args['title']); ?></h2>
    <?php endif; ?>

    <div class="pwt-testimonials-grid">

        <?php foreach ($pwt_items as $pwt_item) : ?>

            <?php
            $pwt_name = (string) ($pwt_item['name'] ?? '');
            $pwt_role = (string) ($pwt_item['role'] ?? '');
            $pwt_content = (string) ($pwt_item['content'] ?? '');
            $pwt_rating = min(5, max(1, (int) ($pwt_item['rating'] ?? 5)));
            $pwt_avatar = (int) ($pwt_item['avatar'] ?? 0);
            ?>

            <figure class="pwt-testimonial">

                <div class="pwt-testimonial-stars" aria-label="<?php echo esc_attr(sprintf(
                    /* translators: %d: star rating. */
                    __('Rated %d out of 5', 'wildtours-base'),
                    $pwt_rating
                )); ?>">

                    <?php foreach (range(1, 5) as $pwt_star) : ?>
                        <svg
                            viewBox="0 0 24 24"
                            width="16"
                            height="16"
                            aria-hidden="true"
                            fill="<?php echo $pwt_star <= $pwt_rating ? 'currentColor' : 'none'; ?>"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    <?php endforeach; ?>

                </div>

                <blockquote class="pwt-testimonial-content">
                    <p><?php echo esc_html($pwt_content); ?></p>
                </blockquote>

                <figcaption class="pwt-testimonial-footer">

                    <?php if ($pwt_avatar > 0) : ?>
                        <?php
                        echo wp_get_attachment_image(
                            $pwt_avatar,
                            'square',
                            false,
                            ['class' => 'pwt-testimonial-avatar', 'loading' => 'lazy']
                        );
                        ?>
                    <?php endif; ?>

                    <span class="pwt-testimonial-author">
                        <strong><?php echo esc_html($pwt_name); ?></strong>

                        <?php if ($pwt_role !== '') : ?>
                            <small><?php echo esc_html($pwt_role); ?></small>
                        <?php endif; ?>
                    </span>

                </figcaption>

            </figure>

        <?php endforeach; ?>

    </div>

</section>
