/* Global frontend behaviors for the base theme. */

(function () {
    'use strict';

    var prefersReducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    function hasClass(el, name) {
        return el.classList.contains(name);
    }

    /* ------------------------------------------------------------------
     * Header elevation on scroll
     * ---------------------------------------------------------------- */
    function initHeaderShadow() {
        var header = document.querySelector('.site-header');

        if (!header) {
            return;
        }

        var toggle = function () {
            header.classList.toggle(
                'is-scrolled',
                window.scrollY > 8
            );
        };

        toggle();

        if ('requestAnimationFrame' in window) {
            var ticking = false;

            window.addEventListener(
                'scroll',
                function () {
                    if (!ticking) {
                        window.requestAnimationFrame(function () {
                            toggle();
                            ticking = false;
                        });

                        ticking = true;
                    }
                },
                { passive: true }
            );
        } else {
            window.addEventListener('scroll', toggle, { passive: true });
        }
    }

    /* ------------------------------------------------------------------
     * Gallery lightbox
     * ---------------------------------------------------------------- */
    function initGalleryLightbox() {
        var galleries = document.querySelectorAll('.pwt-gallery');
        var dialog = null;

        galleries.forEach(function (gallery) {
            var items = gallery.querySelectorAll('.pwt-gallery-item');

            if (!items.length) {
                return;
            }

            gallery.addEventListener('click', function (event) {
                var item = event.target.closest('.pwt-gallery-item');

                if (!item || !dialog) {
                    return;
                }

                openLightbox(item);
            });
        });

        function openLightbox(item) {
            if (!dialog) {
                dialog = document.querySelector('.pwt-lightbox');
            }

            if (!dialog) {
                return;
            }

            var full = item.getAttribute('data-full') || '';
            var caption = item.getAttribute('data-caption') || '';

            var image = dialog.querySelector('.pwt-lightbox-image');
            var captionEl = dialog.querySelector('.pwt-lightbox-caption');

            if (image) {
                image.src = full;
                image.alt = caption;
            }

            if (captionEl) {
                captionEl.textContent = caption;
            }

            if (typeof dialog.showModal === 'function') {
                dialog.showModal();
            } else {
                dialog.setAttribute('open', '');
            }
        }

        if (document.querySelector('.pwt-lightbox')) {
            var close = document.querySelector('.pwt-lightbox-close');

            if (close) {
                close.addEventListener('click', closeLightbox);
            }

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeLightbox();
                }
            });

            document.querySelectorAll('.pwt-lightbox').forEach(function (box) {
                box.addEventListener('click', function (event) {
                    if (event.target === box) {
                        closeLightbox();
                    }
                });
            });
        }

        function closeLightbox() {
            if (!dialog) {
                return;
            }

            if (typeof dialog.close === 'function') {
                dialog.close();
            } else {
                dialog.removeAttribute('open');
            }
        }
    }

    /* ------------------------------------------------------------------
     * Animated stat counters
     * ---------------------------------------------------------------- */
    function initStatCounters() {
        var counters = document.querySelectorAll('.pwt-stat-counter');

        if (!counters.length || !('IntersectionObserver' in window)) {
            return;
        }

        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    var el = entry.target;
                    var target = parseFloat(el.getAttribute('data-target')) || 0;
                    var decimals = parseInt(
                        el.getAttribute('data-decimals'),
                        10
                    ) || 0;
                    var duration = prefersReducedMotion ? 0 : 900;
                    var start = null;

                    function step(timestamp) {
                        if (start === null) {
                            start = timestamp;
                        }

                        var progress = duration === 0
                            ? 1
                            : Math.min((timestamp - start) / duration, 1);

                        var eased = 1 - Math.pow(1 - progress, 3);
                        var value = target * eased;

                        el.textContent = decimals > 0
                            ? value.toFixed(decimals)
                            : Math.round(value).toLocaleString();

                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        }
                    }

                    window.requestAnimationFrame(step);
                    observer.unobserve(el);
                });
            },
            { threshold: 0.4 }
        );

        counters.forEach(function (counter) {
            observer.observe(counter);
        });
    }

    /* ------------------------------------------------------------------
     * Back to top
     * ---------------------------------------------------------------- */
    function initBackToTop() {
        var button = document.querySelector('.pwt-back-to-top');

        if (!button) {
            return;
        }

        var update = function () {
            var visible = window.scrollY > 480;

            button.classList.toggle('is-visible', visible);
            button.setAttribute('aria-hidden', visible ? 'false' : 'true');
            button.tabIndex = visible ? 0 : -1;
        };

        update();

        window.addEventListener('scroll', update, { passive: true });

        button.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: prefersReducedMotion ? 'auto' : 'smooth',
            });
        });
    }

    /* ------------------------------------------------------------------
     * Currency switcher
     * ---------------------------------------------------------------- */
    function initCurrencySwitcher() {
        var select = document.querySelector('[data-currency-switcher]');

        if (!select) {
            return;
        }

        select.addEventListener('change', function () {
            var code = select.value;

            if (!code) {
                return;
            }

            document.cookie =
                'wt_currency=' + encodeURIComponent(code) +
                ';path=/;max-age=31536000;samesite=Lax';

            window.location.reload();
        });
    }

    /* ------------------------------------------------------------------
     * Boot
     * ---------------------------------------------------------------- */
    function boot() {
        initHeaderShadow();
        initGalleryLightbox();
        initStatCounters();
        initBackToTop();
        initCurrencySwitcher();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
