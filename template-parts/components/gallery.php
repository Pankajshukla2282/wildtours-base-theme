<?php

/**
 * Gallery + lightbox component.
 *
 * Usage:
 *   wildtours_component( 'gallery', [
 *       'images'   => [ 12, 34, [ 'url' => '...' ] ],   // IDs, URLs or arrays.
 *       'columns'  => 3,
 *       'caption'  => true,
 *       'class'    => '',
 *   ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_images = isset($args['images']) && is_array($args['images'])
    ? $args['images']
    : [];

if ($pwt_images === []) {
    $pwt_post = isset($args['post']) ? (int) $args['post'] : get_the_ID();
    $pwt_field = wildtours_field($pwt_post, 'gallery');

    if (is_array($pwt_field) && $pwt_field !== []) {
        $pwt_images = $pwt_field;
    }
}

$pwt_images = (array) apply_filters(
    'wildtours/base/gallery/images',
    $pwt_images
);

if ($pwt_images === []) {
    return;
}

$pwt_columns = isset($args['columns']) ? (int) $args['columns'] : 3;
$pwt_columns = max(2, min(6, $pwt_columns));
$pwt_caption = !isset($args['caption']) || (bool) $args['caption'];
$pwt_class = isset($args['class']) ? ' ' . trim((string) $args['class']) : '';
?>
<section class="pwt-gallery<?php echo esc_attr($pwt_class); ?>" style="--pwt-gallery-columns: <?php echo esc_attr((string) $pwt_columns); ?>">

    <?php foreach ($pwt_images as $pwt_image) : ?>

        <?php
        $pwt_src = '';
        $pwt_full = '';
        $pwt_caption_text = '';

        if (is_array($pwt_image)) {
            $pwt_src = (string) ($pwt_image['sizes']['card'] ?? $pwt_image['url'] ?? '');
            $pwt_full = (string) ($pwt_image['url'] ?? $pwt_src);
            $pwt_caption_text = (string) ($pwt_image['caption'] ?? '');
        } elseif (is_numeric($pwt_image)) {
            $pwt_attachment = (int) $pwt_image;
            $pwt_src = (string) wp_get_attachment_image_url($pwt_attachment, 'card');
            $pwt_full = (string) wp_get_attachment_image_url($pwt_attachment, 'large');
            $pwt_caption_text = (string) wp_get_attachment_caption($pwt_attachment);
        } elseif (is_string($pwt_image) && $pwt_image !== '') {
            $pwt_src = $pwt_image;
            $pwt_full = $pwt_image;
        }

        if ($pwt_src === '') {
            continue;
        }
        ?>

        <button
            type="button"
            class="pwt-gallery-item"
            data-full="<?php echo esc_url($pwt_full !== '' ? $pwt_full : $pwt_src); ?>"
            data-caption="<?php echo esc_attr($pwt_caption_text); ?>"
            aria-label="<?php echo esc_attr($pwt_caption_text !== '' ? $pwt_caption_text : __('View image', 'wildtours-base')); ?>"
        >
            <img
                src="<?php echo esc_url($pwt_src); ?>"
                alt="<?php echo esc_attr($pwt_caption_text); ?>"
                loading="lazy"
            />

            <?php if ($pwt_caption && $pwt_caption_text !== '') : ?>
                <span class="pwt-gallery-caption"><?php echo esc_html($pwt_caption_text); ?></span>
            <?php endif; ?>
        </button>

    <?php endforeach; ?>

</section>

<dialog class="pwt-lightbox">
    <button
        type="button"
        class="pwt-lightbox-close"
        aria-label="<?php esc_attr_e('Close', 'wildtours-base'); ?>"
    >
        &times;
    </button>
    <img class="pwt-lightbox-image" src="" alt="" />
    <p class="pwt-lightbox-caption"></p>
</dialog>
