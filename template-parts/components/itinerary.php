<?php

/**
 * Day-by-day itinerary component.
 *
 * Usage:
 *   wildtours_component( 'itinerary', [
 *       'post'   => get_the_ID(),                 // Post ID (defaults to current).
 *       'field'  => 'days_itinerary',             // Repeater field name.
 *       'class'  => '',
 *       'intro'  => '',
 *   ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_post = isset($args['post']) ? (int) $args['post'] : get_the_ID();
$pwt_field = isset($args['field']) ? (string) $args['field'] : 'days_itinerary';
$pwt_class = isset($args['class']) ? ' ' . trim((string) $args['class']) : '';
$pwt_intro = isset($args['intro']) ? (string) $args['intro'] : '';

$pwt_days = wildtours_repeater(
    $pwt_post,
    $pwt_field,
    ['title', 'description', 'photo']
);

$pwt_days = (array) apply_filters(
    'wildtours/base/itinerary/days',
    $pwt_days,
    $pwt_post
);

if ($pwt_days === []) {
    return;
}
?>
<section class="pwt-itinerary<?php echo esc_attr($pwt_class); ?>">

    <?php if ($pwt_intro !== '') : ?>
        <p class="pwt-itinerary-intro"><?php echo esc_html($pwt_intro); ?></p>
    <?php endif; ?>

    <ol class="pwt-itinerary-days">

        <?php foreach ($pwt_days as $index => $pwt_day) : ?>

            <?php
            $pwt_day_number = (int) (isset($pwt_day['day'])
                ? $pwt_day['day']
                : $index + 1
            );

            $pwt_day_title = (string) ($pwt_day['title'] ?? '');
            $pwt_day_description = (string) ($pwt_day['description'] ?? '');
            $pwt_day_photo = $pwt_day['photo'] ?? [];

            if ($pwt_day_title === '' && $pwt_day_description === '') {
                continue;
            }
            ?>

            <li class="pwt-itinerary-day" data-day="<?php echo esc_attr((string) $pwt_day_number); ?>">

                <div class="pwt-itinerary-marker">
                    <span class="pwt-itinerary-badge">
                        <?php
                        printf(
                            esc_html__('Day %d', 'wildtours-base'),
                            $pwt_day_number
                        );
                        ?>
                    </span>
                </div>

                <div class="pwt-itinerary-content">

                    <?php if ($pwt_day_title !== '') : ?>
                        <h3 class="pwt-itinerary-title"><?php echo esc_html($pwt_day_title); ?></h3>
                    <?php endif; ?>

                    <?php if ($pwt_day_description !== '') : ?>
                        <p class="pwt-itinerary-text"><?php echo esc_html($pwt_day_description); ?></p>
                    <?php endif; ?>

                    <?php if (is_array($pwt_day_photo)) : ?>

                        <?php
                        $pwt_photo_id = isset($pwt_day_photo['ID'])
                            ? (int) $pwt_day_photo['ID']
                            : 0;

                        if ($pwt_photo_id > 0) {
                            echo wp_get_attachment_image(
                                $pwt_photo_id,
                                'card',
                                false,
                                ['class' => 'pwt-itinerary-photo', 'loading' => 'lazy']
                            );
                        }
                        ?>

                    <?php endif; ?>

                </div>

            </li>

        <?php endforeach; ?>

    </ol>

</section>
