document.addEventListener('DOMContentLoaded', () => {
    const filterBtn = document.getElementById('filter-button');
    const filterDropdown = document.getElementById('filterDropdown');

    const overlay = document.getElementById('overlay');

    filterBtn?.addEventListener('click', () => {
        const isShown = filterDropdown.classList.toggle('show');
        if (isShown) {
            overlay?.classList.add('show');
            filterBtn.style.zIndex = '1002'; // Bring above overlay
            filterDropdown.style.zIndex = '1002';
        } else {
            overlay?.classList.remove('show');
            filterBtn.style.zIndex = '';
            filterDropdown.style.zIndex = '';
        }
    });

    // Close dropdown when clicking outside or overlay
    const closeDropdown = () => {
        filterDropdown?.classList.remove('show');
        overlay?.classList.remove('show');
        if (filterBtn) filterBtn.style.zIndex = '';
        if (filterDropdown) filterDropdown.style.zIndex = '';
    };

    overlay?.addEventListener('click', closeDropdown);

    document.addEventListener('click', (e) => {
        if (filterBtn && filterDropdown && !filterBtn.contains(e.target) && !filterDropdown.contains(e.target) && !overlay?.contains(e.target)) {
            closeDropdown();
        }
    });

    const dateInput = document.getElementById('dateInput');
    dateInput?.addEventListener('change', () => {
        const form = dateInput.closest('form');
        if (form) form.submit();
    });
});
