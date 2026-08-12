/**
 * WildTours Base Theme navigation.
 *
 * Responsive menu/search behavior. Submenus are intentionally controlled by
 * CSS :hover and :focus-within rather than JavaScript arrow controls.
 */
const initNavigation = () => {
    const navigation = document.getElementById('site-navigation');

    if (!navigation) {
        return;
    }

    const button = navigation.querySelector('.menu-toggle');
    const menu = navigation.querySelector('#primary-menu');
    const searchWrap = navigation.querySelector('.header-search');
    const searchToggle = searchWrap ? searchWrap.querySelector('.header-search-toggle') : null;
    const searchPanel = searchWrap ? searchWrap.querySelector('.header-search-panel') : null;
    const searchField = searchWrap ? searchWrap.querySelector('.search-field') : null;

    if (!menu) {
        return;
    }

    const mobileBreakpoint = window.matchMedia('(max-width: 960px)');

    const setMenuState = (expanded) => {
        if (button) {
            button.setAttribute('aria-expanded', String(expanded));
        }

        navigation.classList.toggle('is-open', expanded);
        menu.classList.toggle('is-open', expanded);
        menu.style.display = expanded ? 'grid' : 'none';
    };

    const setSearchState = (expanded, focusField = false) => {
        if (!searchWrap || !searchToggle || !searchPanel) {
            return;
        }

        searchWrap.classList.add('is-collapsible');
        searchWrap.classList.toggle('is-open', expanded);
        searchToggle.setAttribute('aria-expanded', String(expanded));
        searchPanel.hidden = !expanded;

        if (expanded && focusField && searchField) {
            searchField.focus();
        }
    };

    const closeMenu = () => {
        if (mobileBreakpoint.matches) {
            setMenuState(false);
        }
    };

    const closeSearch = () => {
        setSearchState(false);
    };

    const syncMenuState = () => {
        const isMobile = mobileBreakpoint.matches;

        navigation.classList.toggle('is-mobile', isMobile);

        if (button) {
            button.hidden = !isMobile;
        }

        if (isMobile) {
            setMenuState(false);
        } else {
            // Desktop navigation is always visible.
            navigation.classList.add('is-open');
            menu.classList.add('is-open');
            menu.style.display = 'flex';

            if (button) {
                button.setAttribute('aria-expanded', 'true');
            }
        }

        setSearchState(false);
    };

    syncMenuState();

    if (button) {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            const expanded = button.getAttribute('aria-expanded') === 'true';
            setMenuState(!expanded);
        });
    }

    if (searchToggle && searchPanel) {
        setSearchState(false);

        searchToggle.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();

            const expanded = searchToggle.getAttribute('aria-expanded') === 'true';
            setSearchState(!expanded, !expanded);
        });
    }

    document.addEventListener('click', (event) => {
        if (!navigation.contains(event.target)) {
            closeMenu();
            closeSearch();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') {
            return;
        }

        const searchWasOpen = Boolean(
            searchWrap && searchWrap.classList.contains('is-open')
        );

        closeMenu();
        closeSearch();

        if (searchWasOpen && searchToggle) {
            searchToggle.focus();
        } else if (button && mobileBreakpoint.matches) {
            button.focus();
        }
    });

    if (typeof mobileBreakpoint.addEventListener === 'function') {
        mobileBreakpoint.addEventListener('change', syncMenuState);
    } else if (typeof mobileBreakpoint.addListener === 'function') {
        mobileBreakpoint.addListener(syncMenuState);
    }
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNavigation);
} else {
    initNavigation();
}
