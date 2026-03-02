document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.eod-tab');
    const panels = document.querySelectorAll('.eod-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));
            tab.classList.add('active');
            const panel = document.getElementById('panel-' + tab.dataset.tab);
            if (panel) panel.classList.add('active');
        });
    });

    const dateInput = document.querySelector('.eod-date-input');
    dateInput?.addEventListener('change', () => {
        dateInput.closest('form').submit();
    });

    // ===== END SHIFT MODAL =====
    const endShiftBtn = document.getElementById('openEndShift');
    const endShiftModal = document.getElementById('endShiftModal');
    const closeEndShift = document.getElementById('closeEndShift');
    const cancelEndShift = document.getElementById('cancelEndShift');
    const confirmEndShift = document.getElementById('confirmEndShift');
    const overlay = document.getElementById('overlay');

    const openModal = () => {
        endShiftModal?.classList.add('active');
        overlay?.classList.add('show');
    };

    const closeModal = () => {
        endShiftModal?.classList.remove('active');
        overlay?.classList.remove('show');
    };

    endShiftBtn?.addEventListener('click', openModal);
    closeEndShift?.addEventListener('click', closeModal);
    cancelEndShift?.addEventListener('click', closeModal);
    overlay?.addEventListener('click', closeModal);

    confirmEndShift?.addEventListener('click', async () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        try {
            const res = await fetch('/kitchen/end-shift', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': csrfToken, 
                    'Accept': 'application/json' 
                }
            });
            const data = await res.json();
            if (res.ok && data.success) {
                closeModal();
                window.location.reload();
            } else {
                alert(data.message || 'Failed to end shift.');
            }
        } catch (err) {
            alert('Network error. Please try again.');
        }
    });
});

