<?php

/**
 * Search Form
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$searchQuery = get_search_query();

$placeholder = apply_filters(
    'wildtours/base/search_placeholder',
    esc_html__(
        'Search…',
        'wildtours-base'
    )
);

$searchFieldId = function_exists('wp_unique_id')
    ? wp_unique_id('search-field-')
    : 'search-field-' . uniqid('', false);

?>

<form
    role="search"
    method="get"
    class="search-form"
    action="<?php echo esc_url(home_url('/')); ?>"
>

    <label class="screen-reader-text" for="<?php echo esc_attr($searchFieldId); ?>">

        <?php
        esc_html_e(
            'Search for:',
            'wildtours-base'
        );
        ?>

    </label>

    <input
        id="<?php echo esc_attr($searchFieldId); ?>"
        class="search-field"
        type="search"
        name="s"
        value="<?php echo esc_attr($searchQuery); ?>"
        placeholder="<?php echo esc_attr($placeholder); ?>"
        autocomplete="off"
        required
    >

    <button
        class="search-submit"
        type="submit"
    >

        <?php
        esc_html_e(
            'Search',
            'wildtours-base'
        );
        ?>

    </button>

</form>