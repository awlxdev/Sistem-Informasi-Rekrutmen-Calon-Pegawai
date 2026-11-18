import './bootstrap';

// Konfirmasi form tanpa inline JavaScript.
document.addEventListener('submit', (event) => {
    const form = event.target.closest('form[data-confirm]');

    if (!form) {
        return;
    }

    const message = form.dataset.confirm;

    if (message && !window.confirm(message)) {
        event.preventDefault();
    }
});

// Tombol cetak tanpa inline JavaScript.
document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-print]');

    if (!button) {
        return;
    }

    event.preventDefault();
    window.print();
});