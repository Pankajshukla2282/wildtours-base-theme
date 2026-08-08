<?php

/**
 * Floating WhatsApp button.
 *
 * Renders only when a WhatsApp number is configured (Customizer option
 * "whatsapp_number" or the wildtours/base/whatsapp_number filter).
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_number = wildtours_whatsapp_number();

if ($pwt_number === '') {
    return;
}

$pwt_message = (string) apply_filters(
    'wildtours/base/whatsapp_message',
    __('Hello! I would like to know more about your safari tours.', 'wildtours-base')
);
?>
<a
    class="pwt-whatsapp-float"
    href="<?php echo esc_url(sprintf(
        'https://wa.me/%s?text=%s',
        preg_replace('/^\+/', '', $pwt_number),
        rawurlencode($pwt_message)
    )); ?>"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="<?php esc_attr_e('Chat with us on WhatsApp', 'wildtours-base'); ?>"
>
    <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor" aria-hidden="true">
        <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.39-1.47-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.6.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.5 0 1.47 1.07 2.9 1.22 3.1.15.2 2.11 3.22 5.1 4.51.71.31 1.27.49 1.7.63.72.23 1.37.2 1.88.12.57-.09 1.76-.72 2-1.42.25-.7.25-1.3.18-1.42-.07-.13-.27-.2-.57-.35zM12.04 21.5h-.01a9.45 9.45 0 0 1-4.82-1.32l-.35-.2-3.58.94.96-3.49-.23-.36a9.43 9.43 0 0 1-1.45-5.03c0-5.21 4.24-9.45 9.47-9.45a9.4 9.4 0 0 1 6.69 2.77 9.4 9.4 0 0 1 2.77 6.69c0 5.22-4.24 9.45-9.45 9.45zm8.21-17.66A11.25 11.25 0 0 0 12.04 0C5.4 0 .05 5.35.05 11.93c0 2.1.55 4.16 1.6 5.97L0 24l6.25-1.64a11.9 11.9 0 0 0 5.79 1.47c6.64 0 11.99-5.35 11.99-11.93 0-3.19-1.24-6.19-3.5-8.44z" />
    </svg>
</a>
