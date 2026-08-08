<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!function_exists('wildtours_body_classes')) {

    /**
     * Returns the default body classes.
     *
     * This helper exists for backward compatibility.
     *
     * @return array<int,string>
     */
    function wildtours_body_classes(): array
    {
        $classes = [];

        if (!is_singular()) {
            $classes[] = 'hfeed';
        }

        if (!is_active_sidebar('sidebar-1')) {
            $classes[] = 'no-sidebar';
        }

        if (has_custom_logo()) {
            $classes[] = 'has-custom-logo';
        }

        if (wp_is_block_theme()) {
            $classes[] = 'is-block-theme';
        } else {
            $classes[] = 'is-classic-theme';
        }

        /**
         * Allow extensions.
         */
        return apply_filters(
            'wildtours/base/body_classes',
            array_unique($classes)
        );
    }
}

if (!function_exists('wildtours_archive_title')) {

    /**
     * Returns a simplified archive title.
     */
    function wildtours_archive_title(): string
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

        if (is_search()) {
            return sprintf(
                esc_html__(
                    'Search Results for "%s"',
                    'wildtours-base'
                ),
                get_search_query()
            );
        }

        return get_the_archive_title();
    }
}

if (!function_exists('wildtours_excerpt_length')) {

    /**
     * Default excerpt length.
     */
    function wildtours_excerpt_length(): int
    {
        return (int) apply_filters(
            'wildtours/base/excerpt_length',
            30
        );
    }
}

if (!function_exists('wildtours_excerpt_more')) {

    /**
     * Default excerpt suffix.
     */
    function wildtours_excerpt_more(): string
    {
        return (string) apply_filters(
            'wildtours/base/excerpt_more',
            '&hellip;'
        );
    }
}

if (!function_exists('wildtours_sidebar_layout')) {

    /**
     * Returns the sidebar layout for the current view.
     *
     * Values: 'none' (default), 'right'.
     *
     * @return string
     */
    function wildtours_sidebar_layout(): string
    {
        $layout = (string) get_theme_mod(
            'sidebar_layout',
            'none'
        );

        return (string) apply_filters(
            'wildtours/base/sidebar_layout',
            $layout
        );
    }
}

if (!function_exists('wildtours_show_sidebar')) {

    /**
     * Whether the primary sidebar should render on this view.
     */
    function wildtours_show_sidebar(): bool
    {
        if (!is_active_sidebar('sidebar-1')) {
            return false;
        }

        if (!in_array(wildtours_sidebar_layout(), ['right'], true)) {
            return false;
        }

        if (is_singular()) {
            $postType = get_post_type();

            if (
                is_string($postType)
                && str_starts_with($postType, 'pwt_')
            ) {
                return false;
            }
        }

        if (is_post_type_archive() && str_starts_with((string) get_post_type(), 'pwt_')) {
            return false;
        }

        return true;
    }
}

if (!function_exists('wildtours_component')) {

    /**
     * Render a reusable component from template-parts/components.
     *
     * @param string               $name Component slug (file name).
     * @param array<string, mixed> $args Arguments exposed to the component.
     */
    function wildtours_component(string $name, array $args = []): void
    {
        get_template_part(
            'template-parts/components/' . $name,
            null,
            $args
        );
    }
}

if (!function_exists('wildtours_currencies')) {

    /**
     * Currencies supported by the price/currency helpers.
     *
     * @return array<string,string> ISO code => symbol.
     */
    function wildtours_currencies(): array
    {
        $currencies = [
            'INR' => '₹',
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'AED' => 'د.إ',
        ];

        return (array) apply_filters(
            'wildtours/base/currencies',
            $currencies
        );
    }
}

if (!function_exists('wildtours_currency')) {

    /**
     * Returns the active currency code.
     */
    function wildtours_currency(): string
    {
        $currencies = wildtours_currencies();

        $cookie = isset($_COOKIE['wt_currency'])
            ? sanitize_key((string) wp_unslash($_COOKIE['wt_currency']))
            : '';

        if (isset($currencies[$cookie])) {
            $code = $cookie;
        } else {
            $code = (string) apply_filters(
                'wildtours/base/default_currency',
                'INR'
            );
        }

        return (string) apply_filters(
            'wildtours/base/currency',
            $code
        );
    }
}

if (!function_exists('wildtours_currency_symbol')) {

    /**
     * Returns the symbol for a currency code.
     */
    function wildtours_currency_symbol(string $currency = ''): string
    {
        if ($currency === '') {
            $currency = wildtours_currency();
        }

        $currencies = wildtours_currencies();

        return $currencies[$currency] ?? $currency;
    }
}

if (!function_exists('wildtours_currency_rates')) {

    /**
     * Exchange rates relative to the base currency.
     *
     * @return array<string,float>
     */
    function wildtours_currency_rates(): array
    {
        $rates = [
            'INR' => 1.0,
            'USD' => 0.012,
            'EUR' => 0.011,
            'GBP' => 0.0095,
            'AED' => 0.044,
        ];

        return (array) apply_filters(
            'wildtours/base/currency_rates',
            $rates
        );
    }
}

if (!function_exists('wildtours_convert_amount')) {

    /**
     * Convert an amount (base currency) into the active currency.
     */
    function wildtours_convert_amount(float $amount, string $currency = ''): float
    {
        if ($currency === '') {
            $currency = wildtours_currency();
        }

        $rates = wildtours_currency_rates();
        $rate = $rates[$currency] ?? 1.0;

        return (float) apply_filters(
            'wildtours/base/currency/rate',
            $amount * $rate,
            $amount,
            $currency
        );
    }
}

if (!function_exists('wildtours_price')) {

    /**
     * Format an amount in the active currency.
     *
     * @param int|float|string $amount
     */
    function wildtours_price($amount, string $currency = ''): string
    {
        $amount = (float) $amount;

        if ($currency === '') {
            $currency = wildtours_currency();
        }

        $converted = wildtours_convert_amount($amount, $currency);

        $formatted = $currency === 'INR'
            ? sprintf(
                '₹%s',
                number_format_i18n($converted, 0)
            )
            : sprintf(
                '%s%s',
                wildtours_currency_symbol($currency),
                number_format_i18n($converted, 0)
            );

        return (string) apply_filters(
            'wildtours/base/price',
            $formatted,
            $amount,
            $currency,
            $converted
        );
    }
}

if (!function_exists('wildtours_field')) {

    /**
     * Read a custom field, preferring the companion plugin SCF/ACF layer.
     *
     * @param mixed $default
     * @return mixed
     */
    function wildtours_field(int $postId, string $name, $default = '')
    {
        if (class_exists(\PWT\Frontend\Content::class)) {
            $value = \PWT\Frontend\Content::getField($postId, $name);

            if ($value !== null && $value !== '' && $value !== false) {
                return $value;
            }
        }

        return get_post_meta($postId, $name, true) ?: $default;
    }
}

if (!function_exists('wildtours_repeater')) {

    /**
     * Read a repeater field (itinerary days, FAQ rows, ...).
     *
     * @param string[] $subFields
     * @return array<int,array<string,mixed>>
     */
    function wildtours_repeater(int $postId, string $name, array $subFields = []): array
    {
        if (class_exists(\PWT\Frontend\Content::class)) {
            $rows = \PWT\Frontend\Content::getRepeaterRows(
                $postId,
                $name,
                $subFields
            );

            if ($rows !== []) {
                return $rows;
            }
        }

        $count = (int) get_post_meta($postId, $name, true);

        if ($count < 1) {
            return [];
        }

        $rows = [];

        foreach (range(0, $count - 1) as $index) {
            $row = [];

            foreach ($subFields as $subField) {
                $row[$subField] = get_post_meta(
                    $postId,
                    sprintf('%s_%d_%s', $name, $index, $subField),
                    true
                );
            }

            if (array_filter($row, static fn ($item): bool => $item !== '' && $item !== null)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }
}

if (!function_exists('wildtours_lines_to_items')) {

    /**
     * Split newline delimited text into a clean list.
     *
     * @return string[]
     */
    function wildtours_lines_to_items(string $text): array
    {
        $lines = preg_split('/\R+/u', trim($text));

        if (!is_array($lines)) {
            return [];
        }

        $lines = array_map(
            static fn (string $line): string => trim($line, " \t-•"),
            $lines
        );

        return array_values(
            array_filter($lines, static fn (string $line): bool => $line !== '')
        );
    }
}

if (!function_exists('wildtours_whatsapp_number')) {

    /**
     * WhatsApp number for the floating chat button.
     */
    function wildtours_whatsapp_number(): string
    {
        $number = (string) get_theme_mod(
            'whatsapp_number',
            ''
        );

        return (string) apply_filters(
            'wildtours/base/whatsapp_number',
            preg_replace('/[^0-9+]/', '', $number)
        );
    }
}

if (!function_exists('wildtours_archive_columns')) {

    /**
     * Number of columns for travel post type archives.
     */
    function wildtours_archive_columns(): int
    {
        $columns = (int) get_theme_mod(
            'max_post_columns',
            3
        );

        return max(
            2,
            min(4, (int) apply_filters('wildtours/base/archive_columns', $columns))
        );
    }
}

if (!function_exists('wildtours_pingback_header')) {

    /**
     * Prints the pingback header.
     *
     * Exists for compatibility with classic themes.
     */
    function wildtours_pingback_header(): void
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
}