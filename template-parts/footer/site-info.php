<?php

/**
 * Footer Site Info
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<div class="site-info">

    <p>

        &copy;
        <?php echo esc_html(wp_date('Y')); ?>

        <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php bloginfo('name'); ?>
        </a>

    </p>

</div>