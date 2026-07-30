document.addEventListener('DOMContentLoaded', () => {

    const button = document.querySelector('.menu-toggle');

    const menu = document.getElementById('primary-menu');

    if (!button || !menu) {
        return;
    }

    button.addEventListener('click', () => {

        const expanded =
            button.getAttribute('aria-expanded') === 'true';

        button.setAttribute(
            'aria-expanded',
            String(!expanded)
        );

        menu.classList.toggle('is-open');

    });

});