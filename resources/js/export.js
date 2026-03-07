/**
 * Export System — Date Range Modal + Server-Side CSV / Print-to-PDF
 * 
 * Usage on export buttons:
 *   data-export-url="/export/pos-history"   → server-side CSV with date range modal
 *   data-export-type="print"                → window.print() for report pages
 */

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('exportDateRangeModal');
    const overlay = document.getElementById('exportOverlay');
    if (!modal) return;

    const dateFrom = document.getElementById('exportDateFrom');
    const dateTo = document.getElementById('exportDateTo');
    const confirmBtn = document.getElementById('exportConfirmBtn');
    const cancelBtn = document.getElementById('exportCancelBtn');

    // Default dates: today
    const today = new Date().toISOString().split('T')[0];

    let pendingExportUrl = '';

    // Attach to all export buttons
    document.querySelectorAll('[data-export-url], [data-export-name]').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const exportType = this.dataset.exportType;
            
            if (exportType === 'print') {
                // Report pages: use window.print() for PDF
                window.print();
                return;
            }

            const exportUrl = this.dataset.exportUrl;
            if (exportUrl) {
                // Table pages: show date range modal
                pendingExportUrl = exportUrl;
                dateFrom.value = today;
                dateTo.value = today;
                modal.style.display = 'flex';
                if (overlay) overlay.style.display = 'block';
            }
        });
    });

    // Cancel
    cancelBtn?.addEventListener('click', closeExportModal);
    modal?.addEventListener('click', function(e) {
        if (e.target === modal) closeExportModal();
    });

    function closeExportModal() {
        modal.style.display = 'none';
        if (overlay) overlay.style.display = 'none';
        pendingExportUrl = '';
    }

    // Confirm export
    confirmBtn?.addEventListener('click', function () {
        if (!pendingExportUrl) return;
        const params = new URLSearchParams();
        if (dateFrom.value) params.set('date_from', dateFrom.value);
        if (dateTo.value) params.set('date_to', dateTo.value);
        
        const url = pendingExportUrl + '?' + params.toString();
        window.location.href = url;
        closeExportModal();
    });
});
