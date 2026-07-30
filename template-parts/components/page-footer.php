<?php

/**
 * Page Footer
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!comments_open() && !get_comments_number()) {
    return;
}

comments_template();