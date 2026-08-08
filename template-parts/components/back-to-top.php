<?php

/**
 * Back-to-top button component.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;
?>
<button
    type="button"
    class="pwt-back-to-top"
    aria-hidden="true"
    tabindex="-1"
>
    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="m5 15 7-7 7 7" />
    </svg>
    <span class="screen-reader-text"><?php esc_html_e('Back to top', 'wildtours-base'); ?></span>
</button>
