import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener(
    'submit',
    (event) => {
        const form = event.target;

        if (!(form instanceof HTMLFormElement) || !form.matches('[data-confirm-delete]')) {
            return;
        }

        if (form.dataset.submitting === 'true') {
            event.preventDefault();
            return;
        }

        const message = form.dataset.confirmMessage || 'Are you sure you want to delete this item?';

        if (!window.confirm(message)) {
            event.preventDefault();
            return;
        }

        form.dataset.submitting = 'true';

        const submitButton = form.querySelector('[data-delete-submit]');

        if (submitButton instanceof HTMLButtonElement) {
            submitButton.disabled = true;
            submitButton.classList.add('opacity-60', 'cursor-not-allowed');
        }
    },
    true,
);
