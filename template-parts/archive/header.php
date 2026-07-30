<?php

/**
 * Archive Header
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<header class="archive-header">

    <?php
    the_archive_title(
        '<h1 class="archive-title">',
        '</h1>'
    );

    the_archive_description(
        '<div class="archive-description">',
        '</div>'
    );
    ?>

</header>