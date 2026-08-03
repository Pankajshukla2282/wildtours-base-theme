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

    if (is_admin()) {

        add_action(
            'admin_notices',
            static function (): void {
                ?>
                <div class="notice notice-error">
                    <p>
                        <?php esc_html_e(
                            'WildTours Base Theme requires Composer dependencies. Please run "composer install".',
                            'wildtours-base-theme'
                        ); ?>
                    </p>
                </div>
                <?php
            }
        );

    }

    error_log('[WildTours Base Theme] Composer autoload.php not found.');

    return;
}

require_once $autoload;

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
