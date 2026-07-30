<?php

/**
 * Author Box Component
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!is_singular()) {
    return;
}

$postType = get_post_type();

if (!$postType || !post_type_supports($postType, 'author')) {
    return;
}

$authorId = (int) get_the_author_meta('ID');

$description = trim((string) get_the_author_meta('description', $authorId));

$showEmpty = (bool) apply_filters(
    'wildtours/base/show_empty_author_box',
    false
);

if ($description === '' && !$showEmpty) {
    return;
}

?>

<section
    class="author-box"
    itemscope
    itemtype="https://schema.org/Person"
>

    <?php
    do_action(
        'wildtours/base/before_author_box',
        $authorId
    );
    ?>

    <div class="author-box__avatar">

        <?php

        echo get_avatar(
            $authorId,
            96,
            '',
            get_the_author(),
            [
                'class' => 'author-avatar',
                'loading' => 'lazy',
            ]
        );

        ?>

    </div>

    <div class="author-box__content">

        <h2
            class="author-box__name"
            itemprop="name"
        >

            <a
                href="<?php echo esc_url(get_author_posts_url($authorId)); ?>"
                rel="author"
            >

                <?php echo esc_html(get_the_author()); ?>

            </a>

        </h2>

        <?php if ($description !== '') : ?>

            <div
                class="author-box__description"
                itemprop="description"
            >

                <?php echo wp_kses_post(wpautop($description)); ?>

            </div>

        <?php endif; ?>

        <?php

        /**
         * Child themes/plugins
         * may append social links,
         * expertise,
         * badges,
         * etc.
         */
        do_action(
            'wildtours/base/author_box_meta',
            $authorId
        );

        ?>

    </div>

    <?php

    do_action(
        'wildtours/base/after_author_box',
        $authorId
    );

    ?>

</section>