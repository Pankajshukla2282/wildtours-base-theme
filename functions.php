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
| Theme Information
|--------------------------------------------------------------------------
*/

$theme = wp_get_theme();

define('WILDTOURS_BASE_VERSION', (string) $theme->get('Version'));
define('WILDTOURS_BASE_PATH', trailingslashit(__DIR__));
define('WILDTOURS_BASE_URL', trailingslashit(get_theme_file_uri()));

/*
|--------------------------------------------------------------------------
| Environment
|--------------------------------------------------------------------------
*/

define(
    'WILDTOURS_ENV',
    wp_get_environment_type()
);

define(
    'WILDTOURS_DEBUG',
    defined('WP_DEBUG') && WP_DEBUG
);


/*
|--------------------------------------------------------------------------
| Companion Plugin Detection
|--------------------------------------------------------------------------
*/

define(
    'WILDTOURS_PLUGIN_ACTIVE',
    class_exists(\PWT\Core\Application::class)
);


/*
|--------------------------------------------------------------------------
| Composer Autoloader
|--------------------------------------------------------------------------
*/

$autoload = WILDTOURS_BASE_PATH . 'vendor/autoload.php';

if (! file_exists($autoload)) {

    if (WILDTOURS_DEBUG) {
        error_log('[WildTours Base Theme] Composer autoload.php not found. Using fallback autoloader.');
    }

    spl_autoload_register(
        static function (string $class): void {
            $prefix = 'WildTours\\Base\\';

            if (0 !== strpos($class, $prefix)) {
                return;
            }

            $relativeClass = substr($class, strlen($prefix));
            $path = WILDTOURS_BASE_PATH . 'app/' . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($path)) {
                require_once $path;
            }
        }
    );
} else {
    require_once $autoload;
}

/*
|--------------------------------------------------------------------------
| Compatibility Layer
|--------------------------------------------------------------------------
*/

foreach (
    [
        'inc/compatibility.php',
        'inc/deprecated.php',
        'inc/template-functions.php',
        'inc/template-tags.php',
    ] as $file
) {

    $path = WILDTOURS_BASE_PATH . $file;

    if (file_exists($path)) {
        require_once $path;
    }

}

/*
|--------------------------------------------------------------------------
| Bootstrap Application
|--------------------------------------------------------------------------
*/

WildTours\Base\Core\Application::boot();
