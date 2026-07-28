<?php
/**
 * WildTours Base Theme
 *
 * Bootstrap file.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

define('WTBT_PATH', get_template_directory());
define('WTBT_URI', get_template_directory_uri());
define('WTBT_VERSION', wp_get_theme()->get('Version'));

require_once WTBT_PATH . '/vendor/autoload.php';

use WildTours\Base\Core\Application;

Application::boot();