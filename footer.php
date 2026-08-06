<?php

/**
 * Theme Footer
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

    </main>

    <footer
        id="colophon"
        class="site-footer"
        role="contentinfo"
    >

        <div class="footer-widgets">

            <?php
            get_template_part(
                'template-parts/footer/widgets'
            );
            ?>

        </div>

        <?php
        get_template_part(
            'template-parts/footer/site',
            'info'
        );
        ?>

        <?php
        get_template_part(
            'template-parts/footer/navigation',
            'footer'
        );
        ?>

    </footer>

</div>

<?php wp_footer(); ?>

</body>
</html>