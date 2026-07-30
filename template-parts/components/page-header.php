<?php

/**
 * Page Header
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (is_front_page()) {
    return;
}

?>

<header class="entry-header">

    <?php
    the_title(
        '<h1 class="entry-title">',
        '</h1>'
    );
    ?>

</header>