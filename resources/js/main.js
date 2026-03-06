document.addEventListener("DOMContentLoaded", () => {
    // 1. SIDEBAR COLLAPSE LOGIC
    const sidebarButton = document.querySelector(".drop-down-container-button");
    const sidebarContainer = document.querySelector(".side-bar-container");
    const spans = document.querySelectorAll(".subsystem-span");

    if (sidebarButton && sidebarContainer) {
        sidebarButton.addEventListener("click", () => {
            sidebarContainer.classList.toggle("collapsed");
            spans.forEach(span => span.classList.toggle("clicked"));
            sidebarButton.classList.toggle("clicked");
        });
    }

    // 2. SUBSYSTEM INTERACTION (HIGHLIGHTING & DROPDOWNS)
    document.querySelectorAll(".subsystem").forEach(subsystem => {
        subsystem.addEventListener("click", function () {
            // A. Handle Highlighting (Yellow Pill)
            // Remove highlight from all subsystems first
            document.querySelectorAll(".subsystem").forEach(s => s.classList.remove("active-page"));
            // Add highlight to the one currently clicked
            this.classList.add("active-page");

            // B. Handle Dropdown Menus (Features)
            const featureContainer = this.nextElementSibling;

            // Look for the specific arrow icon inside this subsystem
            const arrow = this.querySelector(".fa-angles-right");

            // Only try to toggle if there is actually a sub-menu (subsystem-feature)
            if (featureContainer && featureContainer.classList.contains('subsystem-feature')) {
                featureContainer.classList.toggle("active");

                // Rotate the arrow icon if found
                if (arrow) {
                    arrow.classList.toggle("active");
                }
            }
        });
    });

    // 3. LOW STOCK ALERT LOGIC
    const bell = document.getElementById('lowStockBell');
    const popup = document.getElementById('lowStockPopup');
    if (bell && popup) {
        bell.addEventListener('click', (e) => {
            e.stopPropagation();
            popup.classList.toggle('open');
        });
        document.addEventListener('click', () => popup.classList.remove('open'));
    }

    // 4. GLOBAL FORM DOUBLE-SUBMIT PROTECTION
    // Prevents spam-clicking on Add/Save/Submit buttons from creating duplicates
    document.querySelectorAll('form[method="POST"], form[method="post"]').forEach(form => {
        form.addEventListener('submit', function (e) {
            if (form.dataset.submitted === 'true') {
                e.preventDefault();
                return;
            }
            form.dataset.submitted = 'true';

            // Disable all submit buttons in this form
            const buttons = form.querySelectorAll('button[type="submit"], input[type="submit"], .add-button, .save-button, .delete-confirm-button');
            buttons.forEach(btn => {
                btn.disabled = true;
                btn.style.opacity = '0.6';
                btn.style.pointerEvents = 'none';
            });

            // Re-enable after 3 seconds as a safety net (in case submission fails/redirects slowly)
            setTimeout(() => {
                form.dataset.submitted = 'false';
                buttons.forEach(btn => {
                    btn.disabled = false;
                    btn.style.opacity = '';
                    btn.style.pointerEvents = '';
                });
            }, 3000);
        });
    });
});