(() => {
    const pendingForms = new Map();

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (event.defaultPrevented || !(form instanceof HTMLFormElement)) return;

        if (pendingForms.has(form)) {
            event.preventDefault();
            return;
        }

        const button = event.submitter || form.querySelector('button[type="submit"]');
        const loader = button && button.querySelector('.loader-icon');
        if (!loader) return;

        const buttons = Array.from(form.querySelectorAll('button[type="submit"], input[type="submit"]'))
            .filter(control => !control.disabled);
        pendingForms.set(form, { buttons, button, loader });
        loader.classList.remove('d-none');
        button.setAttribute('aria-busy', 'true');
        buttons.forEach(control => { control.disabled = true; });
    });

    // Restore usable buttons when returning through the browser's back/forward cache.
    window.addEventListener('pageshow', function () {
        pendingForms.forEach(({ buttons, button, loader }) => {
            buttons.forEach(control => { control.disabled = false; });
            button.removeAttribute('aria-busy');
            loader.classList.add('d-none');
        });
        pendingForms.clear();
    });
})();
