<?php

/**
 * WildTours Base Theme
 *
 * Bootstrap file.
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/*
|--------------------------------------------------------------------------
| Theme Constants
|--------------------------------------------------------------------------
*/

define('WILDTOURS_BASE_VERSION', '1.0.0');

define('WILDTOURS_BASE_PATH', trailingslashit(__DIR__));

define('WILDTOURS_BASE_URL', trailingslashit(get_template_directory_uri()));

/*
|--------------------------------------------------------------------------
| Composer Autoloader
|--------------------------------------------------------------------------
*/

$autoload = WILDTOURS_BASE_PATH . 'vendor/autoload.php';

if (! file_exists($autoload)) {

    wp_die(
        esc_html__(
            'Composer dependencies are missing. Please run "composer install".',
            'wildtours-base'
        )
    );

}

require_once $autoload;

/*
|--------------------------------------------------------------------------
| Compatibility Layer
|--------------------------------------------------------------------------
*/

require_once WILDTOURS_BASE_PATH . 'inc/compatibility.php';

require_once WILDTOURS_BASE_PATH . 'inc/deprecated.php';

require_once WILDTOURS_BASE_PATH . 'inc/template-functions.php';

require_once WILDTOURS_BASE_PATH . 'inc/template-tags.php';

/*
|--------------------------------------------------------------------------
| Bootstrap Application
|--------------------------------------------------------------------------
*/

WildTours\Base\Core\Application::boot();