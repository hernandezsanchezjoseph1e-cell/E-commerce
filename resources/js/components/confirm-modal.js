document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('confirmModal');
    const form = document.getElementById('confirmModalForm');
    const methodInput = document.getElementById('confirmModalMethod');
    const title = document.getElementById('confirmModalTitle');
    const message = document.getElementById('confirmModalMessage');
    const confirmButton = document.getElementById('confirmModalSubmit');
    const cancelButtons = document.querySelectorAll('[data-confirm-cancel]');
    const triggerButtons = document.querySelectorAll('[data-confirm-button]');

    if (!modal || !form || !methodInput || !title || !message || !confirmButton) {
        return;
    }

    const buttonClasses = {
        danger: 'btn-danger',
        primary: 'btn-primary',
        success: 'btn-success',
        secondary: 'btn-secondary',
    };

    const resetButtonVariant = () => {
        Object.values(buttonClasses).forEach((className) => {
            confirmButton.classList.remove(className);
        });
    };

    const openModal = (button) => {
        const action = button.dataset.confirmAction;
        const method = button.dataset.confirmMethod || 'POST';
        const variant = button.dataset.confirmVariant || 'danger';

        form.action = action;
        title.textContent = button.dataset.confirmTitle || 'Confirmar acción';
        message.textContent = button.dataset.confirmMessage || '¿Seguro que deseas continuar?';
        confirmButton.textContent = button.dataset.confirmText || 'Confirmar';

        methodInput.value = method.toUpperCase();
        methodInput.disabled = method.toUpperCase() === 'POST';

        resetButtonVariant();
        confirmButton.classList.add(buttonClasses[variant] || buttonClasses.danger);

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');

        form.action = '';
        methodInput.value = '';
        methodInput.disabled = true;

        title.textContent = '';
        message.textContent = '';
        confirmButton.textContent = 'Confirmar';

        resetButtonVariant();
        confirmButton.classList.add(buttonClasses.danger);
    };

    triggerButtons.forEach((button) => {
        button.addEventListener('click', () => openModal(button));
    });

    cancelButtons.forEach((button) => {
        button.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});