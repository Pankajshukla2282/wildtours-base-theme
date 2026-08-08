<?php

/**
 * Currency switcher component.
 *
 * Sets a wt_currency cookie and reloads. Currency list is controlled by
 * the wildtours/base/currencies filter.
 *
 * Usage:
 *   wildtours_component( 'currency-switcher', [ 'label' => true ] );
 *
 * @package WildTours\Base
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwt_currencies = wildtours_currencies();

if (count($pwt_currencies) < 2) {
    return;
}

$pwt_current = wildtours_currency();
$pwt_label = isset($args['label']) && (bool) $args['label'];
?>
<label class="pwt-currency-switcher">

    <?php if ($pwt_label) : ?>
        <span class="screen-reader-text">
            <?php esc_html_e('Select currency', 'wildtours-base'); ?>
        </span>
    <?php endif; ?>

    <select
        class="pwt-currency-select"
        data-currency-switcher
        aria-label="<?php esc_attr_e('Select currency', 'wildtours-base'); ?>"
    >
        <?php foreach ($pwt_currencies as $pwt_code => $pwt_symbol) : ?>
            <option
                value="<?php echo esc_attr($pwt_code); ?>"
                <?php selected($pwt_current, $pwt_code); ?>
            >
                <?php echo esc_html($pwt_code . ' (' . $pwt_symbol . ')'); ?>
            </option>
        <?php endforeach; ?>
    </select>

</label>
