const initNavigation = () => {
    const navigation = document.getElementById('site-navigation');
    const button = document.querySelector('.menu-toggle');
    const menu = document.getElementById('primary-menu');

    if (!navigation || !button || !menu) {
        return;
    }

    const mobileBreakpoint = window.matchMedia('(max-width: 960px)');

    const setMenuState = (expanded) => {
        button.setAttribute('aria-expanded', String(expanded));
        navigation.classList.toggle('is-open', expanded);
        menu.classList.toggle('is-open', expanded);
        menu.style.display = expanded ? 'grid' : 'none';
    };

    const setSubmenuState = (item, expanded) => {
        const submenuToggle = item.querySelector(':scope > .submenu-toggle');

        item.classList.toggle('is-open', expanded);

        if (submenuToggle) {
            submenuToggle.setAttribute('aria-expanded', String(expanded));
        }
    };

    menu.querySelectorAll('.menu-item-has-children').forEach((item, index) => {
        const submenu = item.querySelector(':scope > .sub-menu');
        const parentLink = item.querySelector(':scope > a');

        if (!submenu || !parentLink || item.querySelector(':scope > .submenu-toggle')) {
            return;
        }

        if (!submenu.id) {
            submenu.id = `primary-submenu-${index}`;
        }

        const submenuToggle = document.createElement('button');
        submenuToggle.type = 'button';
        submenuToggle.className = 'submenu-toggle';
        submenuToggle.setAttribute('aria-controls', submenu.id);
        submenuToggle.setAttribute('aria-expanded', 'false');

        const screenReaderLabel = document.createElement('span');
        screenReaderLabel.className = 'screen-reader-text';
        screenReaderLabel.textContent = `Toggle submenu for ${parentLink.textContent.trim()}`;

        const icon = document.createElement('span');
        icon.setAttribute('aria-hidden', 'true');
        icon.textContent = '▾';

        submenuToggle.append(screenReaderLabel, icon);

        submenuToggle.addEventListener('click', () => {
            const expanded = submenuToggle.getAttribute('aria-expanded') === 'true';

            setSubmenuState(item, !expanded);
        });

        parentLink.insertAdjacentElement('afterend', submenuToggle);
    });

    const closeMenu = () => {
        if (!mobileBreakpoint.matches) {
            return;
        }

        setMenuState(false);

        menu.querySelectorAll('.menu-item-has-children.is-open').forEach((item) => {
            setSubmenuState(item, false);
        });
    };

    const syncMenuState = () => {
        const isMobile = mobileBreakpoint.matches;

        button.hidden = !isMobile;
        setMenuState(!isMobile);

        if (!isMobile) {
            menu.style.display = 'flex';
            button.setAttribute('aria-expanded', 'true');
        }

        menu.querySelectorAll('.menu-item-has-children.is-open').forEach((item) => {
            setSubmenuState(item, false);
        });

        navigation.classList.toggle('is-mobile', isMobile);
    };

    syncMenuState();

    button.addEventListener('click', () => {
        const expanded = button.getAttribute('aria-expanded') === 'true';

        setMenuState(!expanded);
    });

    document.addEventListener('click', (event) => {
        if (!navigation.contains(event.target)) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenu();
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