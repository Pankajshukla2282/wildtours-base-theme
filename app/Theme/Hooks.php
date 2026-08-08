<?php

declare(strict_types=1);

namespace WildTours\Base\Theme;

defined('ABSPATH') || exit;

/**
 * Registers global theme hooks.
 *
 * @package WildTours\Base
 */
final class Hooks
{
    /**
     * Boot hooks.
     */
    public function boot(): void
    {
        add_action(
            'wp_head',
            [$this, 'pingbackHeader']
        );

        add_filter(
            'body_class',
            [$this, 'bodyClasses']
        );

        add_filter(
            'excerpt_more',
            [$this, 'excerptMore']
        );

        add_filter(
            'excerpt_length',
            [$this, 'excerptLength'],
            20
        );

        add_filter(
            'get_the_archive_title',
            [$this, 'archiveTitle']
        );

        add_action(
            'init',
            [$this, 'handleNewsletter']
        );

        add_action(
            'wp_footer',
            [$this, 'outputFloatingElements']
        );

        /**
         * Uncomment only if you intentionally want
         * to disable WordPress automatic image scaling.
         */
        // add_filter(
        //     'big_image_size_threshold',
        //     '__return_false'
        // );
    }

    /**
     * Add pingback URL for singular pages.
     */
    public function pingbackHeader(): void
    {
        if (
            is_singular()
            && pings_open()
        ) {
            printf(
                '<link rel="pingback" href="%s">',
                esc_url(
                    get_bloginfo('pingback_url')
                )
            );
        }
    }

    /**
     * Add custom body classes.
     *
     * @param array<int,string> $classes
     * @return array<int,string>
     */
    public function bodyClasses(array $classes): array
    {
        if (!is_singular()) {
            $classes[] = 'hfeed';
        }

        if (!is_active_sidebar('sidebar-1')) {
            $classes[] = 'no-sidebar';
        }

        if (has_custom_logo()) {
            $classes[] = 'has-custom-logo';
        }

        if (function_exists('wildtours_show_sidebar') && wildtours_show_sidebar()) {
            $classes[] = 'layout-has-sidebar';
        }

        if (wp_is_block_theme()) {
            $classes[] = 'is-block-theme';
        } else {
            $classes[] = 'is-classic-theme';
        }

        return array_unique($classes);
    }

    /**
     * Customize excerpt more text.
     */
    public function excerptMore(): string
    {
        return '&hellip;';
    }

    /**
     * Customize excerpt length.
     */
    public function excerptLength(): int
    {
        return 30;
    }

    /**
     * Simplify archive titles.
     */
    public function archiveTitle(string $title): string
    {
        if (is_category()) {
            return single_cat_title('', false);
        }

        if (is_tag()) {
            return single_tag_title('', false);
        }

        if (is_author()) {
            return get_the_author();
        }

        if (is_post_type_archive()) {
            return post_type_archive_title('', false);
        }

        return $title;
    }

    /**
     * Capture newsletter submissions.
     *
     * Stored in the wildtours_newsletter_subscribers option; plugins can
     * intercept the wildtours/base/newsletter/handler filter instead.
     */
    public function handleNewsletter(): void
    {
        if (!isset($_POST['pwt_newsletter'])) {
            return;
        }

        $payload = wp_unslash($_POST['pwt_newsletter']); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput

        $email = isset($payload['email'])
            ? sanitize_email((string) $payload['email'])
            : '';

        $nonce = isset($payload['nonce'])
            ? sanitize_key((string) $payload['nonce'])
            : '';

        if (
            $email === ''
            || !wp_verify_nonce($nonce, 'pwt_newsletter')
        ) {
            wp_safe_redirect(
                add_query_arg('pwt_newsletter', 'error', home_url('/'))
            );
            exit;
        }

        /**
         * Let plugins handle the subscription themselves.
         */
        $handled = apply_filters(
            'wildtours/base/newsletter/handler',
            false,
            $email
        );

        if (!$handled) {
            $subscribers = (array) get_option(
                'wildtours_newsletter_subscribers',
                []
            );

            $subscribers[md5($email)] = [
                'email' => $email,
                'date' => current_time('mysql'),
            ];

            update_option(
                'wildtours_newsletter_subscribers',
                array_slice($subscribers, -500, 500, true)
            );
        }

        wp_safe_redirect(
            add_query_arg('pwt_newsletter', 'success', home_url('/'))
        );
        exit;
    }

    /**
     * Output floating UI elements (WhatsApp + back to top).
     */
    public function outputFloatingElements(): void
    {
        wildtours_component('whatsapp-float');
        wildtours_component('back-to-top');
    }
}