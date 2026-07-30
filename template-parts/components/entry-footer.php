<?php

/**
 * Entry Footer
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<div class="entry-footer-meta">

    <?php

    the_tags(
        '<span class="post-tags">',
        '',
        '</span>'
    );

    ?>

</div>