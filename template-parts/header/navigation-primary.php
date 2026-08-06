<?php

/**
 * Primary Navigation
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

?>

<nav
    id="site-navigation"
    class="primary-navigation"
    aria-label="<?php esc_attr_e('Primary Navigation', 'wildtours-base'); ?>"
>

    <button
        class="menu-toggle"
        type="button"
        aria-controls="primary-menu"
        aria-expanded="false"
    >

        <span class="screen-reader-text">
            <?php esc_html_e('Toggle navigation', 'wildtours-base'); ?>
        </span>

        <span class="menu-toggle__icon" aria-hidden="true">
            ☰
        </span>

    </button>

    <?php

    wp_nav_menu([
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'menu_class'     => 'primary-menu',
        'container'      => false,
        'fallback_cb'    => static function (): void {
            $maxTopLevelItems = 10;

            $getMenuStructure = static function (int $menuId): array {
                $items = wp_get_nav_menu_items($menuId);

                if (empty($items)) {
                    return [
                        'top' => 0,
                        'children' => 0,
                    ];
                }

                $topLevelCount = 0;
                $childCount = 0;

                foreach ($items as $item) {

                    if (0 === (int) $item->menu_item_parent) {
                        ++$topLevelCount;
                    } else {
                        ++$childCount;
                    }
                }

                return [
                    'top' => $topLevelCount,
                    'children' => $childCount,
                ];
            };

            $fallbackMenuId = 0;
            $registeredLocations = get_nav_menu_locations();
            $locationPriority = [
                'secondary',
                'social',
                'footer',
            ];

            foreach ($locationPriority as $location) {

                if (empty($registeredLocations[$location])) {
                    continue;
                }

                $menuId = (int) $registeredLocations[$location];
                $structure = $getMenuStructure($menuId);

                if ($structure['top'] > 0 && $structure['children'] > 0) {
                    $fallbackMenuId = $menuId;
                    break;
                }
            }

            if (0 === $fallbackMenuId) {

                foreach ($registeredLocations as $location => $menuId) {

                    if ('primary' === $location || empty($menuId)) {
                        continue;
                    }

                    $structure = $getMenuStructure((int) $menuId);

                    if ($structure['top'] > 0) {
                        $fallbackMenuId = (int) $menuId;
                        break;
                    }
                }
            }

            if (0 === $fallbackMenuId) {

                $availableMenus = wp_get_nav_menus();
                $bestMenuId = 0;
                $bestScore = -1;

                foreach ($availableMenus as $menu) {

                    $structure = $getMenuStructure((int) $menu->term_id);

                    if ($structure['top'] <= 0) {
                        continue;
                    }

                    $score = 0;

                    if ($structure['children'] > 0) {
                        $score += 100;
                    }

                    if ($structure['top'] <= $maxTopLevelItems) {
                        $score += 20;
                    }

                    $score -= $structure['top'];

                    if ($score > $bestScore) {
                        $bestScore = $score;
                        $bestMenuId = (int) $menu->term_id;
                    }
                }

                if ($bestMenuId > 0) {
                    $fallbackMenuId = $bestMenuId;
                }
            }

            if (0 !== $fallbackMenuId) {

                wp_nav_menu([
                    'menu'        => $fallbackMenuId,
                    'menu_id'     => 'primary-menu',
                    'menu_class'  => 'primary-menu primary-menu--fallback',
                    'container'   => false,
                    'fallback_cb' => false,
                    'depth'       => 3,
                ]);

                return;
            }

            $pages = get_pages([
                'parent'      => 0,
                'sort_column' => 'menu_order,post_title',
                'post_status' => 'publish',
                'number'      => $maxTopLevelItems,
            ]);

            if (empty($pages)) {
                return;
            }

            $currentPageId = (int) get_queried_object_id();
            $ancestorIds = [];

            if ($currentPageId > 0) {
                $ancestorIds = array_map(
                    'intval',
                    get_post_ancestors($currentPageId)
                );
            }

            echo '<ul id="primary-menu" class="primary-menu primary-menu--fallback">';

            foreach ($pages as $page) {

                $childPages = get_pages([
                    'parent'      => (int) $page->ID,
                    'sort_column' => 'menu_order,post_title',
                    'post_status' => 'publish',
                ]);

                $classes = [
                    'menu-item',
                    'page_item',
                    'page-item-' . (string) $page->ID,
                ];

                if (!empty($childPages)) {
                    $classes[] = 'menu-item-has-children';
                    $classes[] = 'page_item_has_children';
                }

                if ($currentPageId === (int) $page->ID) {
                    $classes[] = 'current_page_item';
                    $classes[] = 'current-menu-item';
                }

                if (in_array((int) $page->ID, $ancestorIds, true)) {
                    $classes[] = 'current_page_ancestor';
                    $classes[] = 'current-menu-ancestor';
                }

                $classAttribute = esc_attr(implode(' ', $classes));

                echo '<li class="' . $classAttribute . '">';
                echo '<a href="' . esc_url(get_permalink($page->ID)) . '">';
                echo esc_html($page->post_title);
                echo '</a>';

                if (!empty($childPages)) {
                    echo '<ul class="sub-menu children">';

                    foreach ($childPages as $childPage) {

                        $childClasses = [
                            'menu-item',
                            'page_item',
                            'page-item-' . (string) $childPage->ID,
                        ];

                        if ($currentPageId === (int) $childPage->ID) {
                            $childClasses[] = 'current_page_item';
                            $childClasses[] = 'current-menu-item';
                        }

                        if (in_array((int) $childPage->ID, $ancestorIds, true)) {
                            $childClasses[] = 'current_page_ancestor';
                            $childClasses[] = 'current-menu-ancestor';
                        }

                        $childClassAttribute = esc_attr(implode(' ', $childClasses));

                        echo '<li class="' . $childClassAttribute . '">';
                        echo '<a href="' . esc_url(get_permalink($childPage->ID)) . '">';
                        echo esc_html($childPage->post_title);
                        echo '</a>';
                        echo '</li>';
                    }

                    echo '</ul>';
                }

                echo '</li>';
            }

            echo '</ul>';
        },
        'depth'          => 3,
    ]);

    ?>

</nav>