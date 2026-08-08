<?php

/**
 * Newsletter subscribe component.
 *
 * Submissions POST to the same URL with a pwt_newsletter[email] payload;
 * the theme captures it on init (see Hooks::handleNewsletter) and stores
 * subscribers in the wildtours_newsletter_subscribers option. Plugins can
 * replace the storage via the wildtours/base/newsletter/handler filter.
 *
 * Usage:
 *   wildtours_component( 'newsletter', [
 *       'title' => 'Get safari deals',
 *       'text'  => 'One email a month, no spam.',
 *       'class' => '',
 *   ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_title = (string) ($args['title'] ?? __('Get travel deals', 'wildtours-base'));
$pwt_text = (string) ($args['text'] ?? __('Subscribe for seasonal offers and safari tips.', 'wildtours-base'));
$pwt_class = isset($args['class']) ? ' ' . trim((string) $args['class']) : '';

$pwt_success = isset($_GET['pwt_newsletter']) && (string) $_GET['pwt_newsletter'] === 'success';
?>
<section class="pwt-newsletter<?php echo esc_attr($pwt_class); ?>">

    <div class="pwt-newsletter-body">

        <h3 class="pwt-newsletter-title"><?php echo esc_html($pwt_title); ?></h3>

        <?php if ($pwt_text !== '') : ?>
            <p class="pwt-newsletter-text"><?php echo esc_html($pwt_text); ?></p>
        <?php endif; ?>

    </div>

    <?php if ($pwt_success) : ?>

        <p class="pwt-newsletter-success" role="status">
            <?php esc_html_e('Thank you! Please check your inbox to confirm your subscription.', 'wildtours-base'); ?>
        </p>

    <?php else : ?>

        <form
            class="pwt-newsletter-form"
            method="post"
            action="<?php echo esc_url(home_url('/')); ?>"
            novalidate
        >

            <input type="hidden" name="pwt_newsletter[nonce]" value="<?php echo esc_attr(wp_create_nonce('pwt_newsletter')); ?>" />

            <label class="screen-reader-text" for="pwt-newsletter-email">
                <?php esc_html_e('Email address', 'wildtours-base'); ?>
            </label>

            <input
                id="pwt-newsletter-email"
                type="email"
                name="pwt_newsletter[email]"
                placeholder="<?php esc_attr_e('Your email address', 'wildtours-base'); ?>"
                required
                autocomplete="email"
            />

            <button type="submit" class="pwt-btn">
                <?php esc_html_e('Subscribe', 'wildtours-base'); ?>
            </button>

        </form>

    <?php endif; ?>

</section>
