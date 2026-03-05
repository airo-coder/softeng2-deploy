document.addEventListener('DOMContentLoaded', () => {
    // Removed Filter/Overlay logic here because mp.js handles it now.
    // mp.js manages #filter-button, #filterDropdown, and #overlay.

    // DATE FILTER LOGIC
    const dateInput = document.getElementById('dateInput');

    if (dateInput) {
        dateInput.addEventListener('change', () => {
            const form = dateInput.closest('form');
            if (form) form.submit();
        });
    }
});
