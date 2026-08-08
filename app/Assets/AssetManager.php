<?php

declare(strict_types=1);

namespace WildTours\Base\Assets;

defined('ABSPATH') || exit;

use WildTours\Base\Support\Theme;

/**
 * Registers and enqueues theme assets.
 */
final class AssetManager
{
    /**
     * Register WordPress hooks.
     */
    public function register(): void
    {
        add_action(
            'wp_enqueue_scripts',
            [$this, 'enqueueFrontend']
        );
        
        add_action(
            'wp_enqueue_scripts',
            [$this, 'enqueueNavigation']
        );

        add_action(
            'enqueue_block_editor_assets',
            [$this, 'enqueueEditor']
        );

        add_action(
            'admin_enqueue_scripts',
            [$this, 'enqueueAdmin']
        );

        add_action(
            'login_enqueue_scripts',
            [$this, 'enqueueLogin']
        );
    }

    /**
     * Enqueue frontend assets.
     */
    public function enqueueFrontend(): void
    {
        wp_enqueue_style(
            'wildtours-base',
            Theme::assetUri('css/frontend.css'),
            [],
            Theme::assetVersion('css/frontend.css')
        );

        wp_add_inline_style(
            'wildtours-base',
            'html{overflow-x:clip}body{overflow-x:clip}#page{width:min(1200px,calc(100vw - 2rem));margin:1rem auto 2rem;overflow:clip}.site-header{display:grid;gap:1rem;position:sticky;top:0;z-index:20}.primary-navigation{display:grid;grid-template-columns:minmax(0,1fr) auto;align-items:start;gap:.75rem 1rem;width:100%}.primary-menu{display:none;grid-column:1 / -1;grid-row:2;margin:0;padding:.75rem;border:1px solid rgba(21,37,23,.12);border-radius:18px;background:rgba(255,255,255,.96);box-shadow:0 12px 32px rgba(15,26,18,.08);list-style:none}.breadcrumbs{width:min(860px,calc(100vw - 2rem));margin:1rem auto 0;padding:.75rem 1rem;border:1px solid rgba(21,37,23,.12);border-radius:18px;background:rgba(255,255,255,.92);box-shadow:0 18px 50px rgba(15,26,18,.08);color:#5d6a61}.breadcrumbs .breadcrumb-trail{display:flex;flex-wrap:wrap;align-items:center;gap:.35rem;margin:0;padding:0;list-style:none}.breadcrumbs .breadcrumb-item{display:inline-flex;align-items:center;gap:.35rem}.breadcrumbs .breadcrumb-item+.breadcrumb-item::before{content:"/";color:#5d6a61}body.home .breadcrumbs,body.front-page .breadcrumbs{display:none}.page-header,.archive-header{max-width:860px;margin:0 auto;padding:clamp(1.25rem,2vw,2rem);border:1px solid rgba(21,37,23,.12);border-radius:24px;background:linear-gradient(135deg,rgba(47,111,62,.08),rgba(255,255,255,.92) 55%),rgba(255,255,255,.95);box-shadow:0 18px 50px rgba(15,26,18,.08)}.page-title,.archive-title{margin:0;color:#172018;font-size:clamp(1.9rem,3vw,3.2rem);line-height:1.1;letter-spacing:-.05em}.home .site-main,.front-page .site-main{display:grid;gap:1.25rem}.home .site-main>article,.front-page .site-main>article{padding-top:0;box-shadow:none;background:transparent;border-color:transparent}.pwt-site{max-width:min(1200px,calc(100vw - 2rem));margin:0 auto}.pwt-hero{margin:1rem 0 1.5rem;padding:clamp(2.5rem,6vw,5rem) clamp(1.25rem,3vw,2rem);border-radius:28px}.pwt-section{margin-bottom:1.25rem}.pwt-single-wrap{margin-top:1rem}.pwt-single-hero{margin-bottom:1.25rem}.pwt-single-hero img{height:clamp(240px,32vw,380px)}@media (max-width:960px){.primary-navigation{grid-template-columns:1fr}.menu-toggle,.submenu-toggle{display:inline-flex}.primary-menu{width:100%;padding:.65rem}.breadcrumbs{display:none;width:calc(100vw - 1rem)}.site-header,.site-footer,.site-main{padding-left:.85rem;padding-right:.85rem}}@media (min-width:961px){.menu-toggle,.submenu-toggle{display:none}.primary-navigation>.menu-toggle{display:none}.primary-navigation{grid-template-columns:1fr}.primary-menu{display:flex;align-items:center;flex-wrap:wrap;gap:.4rem;padding:0;border:0;border-radius:0;background:transparent;box-shadow:none}.primary-navigation.is-open .primary-menu,.primary-menu.is-open{display:flex}.primary-menu>li{display:block;padding:0}.primary-menu>li>a{padding-right:1rem}.primary-menu .sub-menu{position:absolute;top:calc(100% + .5rem);left:0;min-width:16rem;padding:.6rem;border:1px solid rgba(21,37,23,.12);border-radius:18px;background:rgba(255,255,255,.98);box-shadow:0 18px 42px rgba(15,26,18,.12)}.primary-menu .sub-menu .sub-menu{top:0;left:calc(100% + .5rem);margin-top:0}.primary-menu .sub-menu li{display:block}.primary-menu .sub-menu a{padding:.55rem .8rem}.primary-menu li:hover>.sub-menu,.primary-menu li:focus-within>.sub-menu{display:grid}}'
        );

        wp_enqueue_script(
            'wildtours-base',
            Theme::assetUri('js/frontend.js'),
            [],
            Theme::assetVersion('js/frontend.js'),
            true
        );
    }

    /**
     * Enqueue editor assets.
     */
    public function enqueueEditor(): void
    {
        wp_enqueue_script(
            'wildtours-base-editor',
            Theme::assetUri('js/editor.js'),
            ['wp-blocks', 'wp-element', 'wp-edit-post'],
            Theme::assetVersion('js/editor.js'),
            true
        );
    }

    /**
     * Enqueue admin assets.
     */
    public function enqueueAdmin(): void
    {
        if (!is_admin()) {
            return;
        }

        wp_enqueue_style(
            'wildtours-base-admin',
            Theme::assetUri('css/admin.css'),
            [],
            Theme::assetVersion('css/admin.css')
        );
    }

    /**
     * Enqueue login assets.
     */
    public function enqueueLogin(): void
    {
        wp_enqueue_style(
            'wildtours-base-login',
            Theme::assetUri('css/login.css'),
            [],
            Theme::assetVersion('css/login.css')
        );
    }

    /**
     * Enqueue Navigation assets.
     */
    public function enqueueNavigation(): void
    {
        wp_enqueue_script(
            'wildtours-navigation',
            Theme::assetUri('js/navigation.js'),
            [],
            Theme::assetVersion('js/navigation.js'),
            true
        );
    }
    

}