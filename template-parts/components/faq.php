<?php

/**
 * FAQ accordion component.
 *
 * Usage:
 *   wildtours_component( 'faq', [
 *       'items' => [
 *           [ 'question' => 'When is the best time?', 'answer' => '...' ],
 *       ],
 *   ] );
 *
 * Without $items it pulls published pwt_faq posts when the companion
 * plugin is active.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_items = isset($args['items']) && is_array($args['items'])
    ? $args['items']
    : [];

if ($pwt_items === [] && post_type_exists('pwt_faq')) {

    $pwt_query = new WP_Query([
        'post_type' => 'pwt_faq',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'no_found_rows' => true,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ]);

    foreach ($pwt_query->posts as $pwt_faq) {
        $pwt_items[] = [
            'question' => get_the_title($pwt_faq),
            'answer' => get_the_content(null, false, $pwt_faq),
        ];
    }

    wp_reset_postdata();
}

$pwt_items = (array) apply_filters(
    'wildtours/base/faq/items',
    $pwt_items
);

if ($pwt_items === []) {
    return;
}
?>
<section class="pwt-faq">

    <?php if (!empty($args['title'])) : ?>
        <h2 class="pwt-faq-title"><?php echo esc_html((string) $args['title']); ?></h2>
    <?php endif; ?>

    <div class="pwt-faq-list">

        <?php foreach ($pwt_items as $pwt_item) : ?>

            <?php
            $pwt_question = (string) ($pwt_item['question'] ?? '');
            $pwt_answer = (string) ($pwt_item['answer'] ?? '');

            if ($pwt_question === '' && $pwt_answer === '') {
                continue;
            }
            ?>

            <details class="pwt-faq-item">

                <summary class="pwt-faq-question">
                    <?php echo esc_html($pwt_question); ?>
                </summary>

                <?php if ($pwt_answer !== '') : ?>
                    <div class="pwt-faq-answer">
                        <?php
                        echo wp_kses_post(
                            wpautop($pwt_answer)
                        );
                        ?>
                    </div>
                <?php endif; ?>

            </details>

        <?php endforeach; ?>

    </div>

</section>
