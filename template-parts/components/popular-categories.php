<?php

$categories = get_categories([
    'orderby' => 'count',
    'order'   => 'DESC',
    'number'  => 8,
]);

if (empty($categories)) {
    return;
}

?>

<section class="popular-categories">

    <h2>

        <?php
        esc_html_e(
            'Popular Categories',
            'wildtours-base'
        );
        ?>

    </h2>

    <ul>

        <?php foreach ($categories as $category) : ?>

            <li>

                <a href="<?php echo esc_url(get_category_link($category)); ?>">

                    <?php echo esc_html($category->name); ?>

                </a>

            </li>

        <?php endforeach; ?>

    </ul>

</section>