document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('deleteUserModal');
    const form = document.getElementById('deleteUserForm');
    const userName = document.getElementById('deleteUserName');
    const cancelButton = document.getElementById('cancelDeleteUser');
    const deleteButtons = document.querySelectorAll('[data-delete-user-button]');

    if (!modal || !form || !userName || !cancelButton || !deleteButtons.length) {
        return;
    }

    const openModal = (button) => {
        form.action = button.dataset.deleteUrl;
        userName.textContent = button.dataset.deleteName;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');

        form.action = '';
        userName.textContent = '';
    };

    deleteButtons.forEach((button) => {
        button.addEventListener('click', () => openModal(button));
    });

    cancelButton.addEventListener('click', closeModal);

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