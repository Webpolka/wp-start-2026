export function initDesktopMenu() {  

    const menu = document.getElementById("mainMenu");

    menu.querySelectorAll('.menu-item-has-children').forEach(item => {

        let timeout;
        const submenu = item.querySelector(':scope > ul');
        if (!submenu) return;

        item.addEventListener('mouseenter', () => {
            clearTimeout(timeout);

            // показать
            submenu.classList.remove('opacity-0', 'invisible', 'pointer-events-none');
            submenu.classList.add('opacity-100', 'visible');

            // ---- AUTO FLIP ----
            setTimeout(() => {

                // сначала вправо стандарт
                submenu.style.left = '';
                submenu.style.right = '';
                submenu.classList.remove('flip-left');

                const rect = submenu.getBoundingClientRect();
                const overflowRight = rect.right > window.innerWidth;

                if (overflowRight) {
                    submenu.classList.add('flip-left');
                }

            }, 20);

        });

        item.addEventListener('mouseleave', () => {
            timeout = setTimeout(() => {
                submenu.classList.remove('opacity-100', 'visible');
                submenu.classList.add('opacity-0', 'invisible', 'pointer-events-none');
            }, 500);
        });

    });
}
