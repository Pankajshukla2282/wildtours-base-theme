/**
 * Editor enhancements for the base theme.
 *
 * @package WildTours\Base
 */

'use strict';

(function (wp) {
    if (!wp || !wp.blocks) {
        return;
    }

    var styles = [
        {
            name: 'wt-card',
            label: 'Card',
        },
        {
            name: 'wt-band',
            label: 'Band',
        },
    ];

    wp.domReady(function () {
        if (wp.blocks.registerBlockStyle) {
            styles.forEach(function (style) {
                wp.blocks.registerBlockStyle('core/group', style);
            });
        }
    });
})(window.wp);
