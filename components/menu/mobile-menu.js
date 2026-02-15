export function initMobileMenu() {
    const burger = document.getElementById("burgerBtn");
    const menu = document.getElementById("mobileMenu");
    const closeBtn = document.getElementById("closeMenu");

    if (!burger || !menu || !closeBtn) return;

    burger.addEventListener("click", () => {
        menu.classList.remove("translate-x-full");
        menu.classList.add("translate-x-0");
        document.body.style.overflow = "hidden";
        burger.setAttribute("aria-expanded", "true");
    });

    closeBtn.addEventListener("click", closeMenu);
    menu.addEventListener("click", e => {
        if (e.target === menu) closeMenu();
    });

    function closeMenu() {
        menu.classList.add("translate-x-full");
        menu.classList.remove("translate-x-0");
        document.body.style.overflow = "";
        burger.setAttribute("aria-expanded", "false");

        menu.querySelectorAll('.submenu').forEach(ul => ul.classList.add('hidden'));
        menu.querySelectorAll('.accordion-toggle').forEach(arrow => arrow.classList.remove('rotate-90'));
    }

    menu.querySelectorAll('.menu-item-has-children > a').forEach(link => {
        link.addEventListener('click', e => {
            if (window.innerWidth >= 768) return;
            e.preventDefault();

            const submenu = link.parentElement.querySelector(':scope > .submenu');
            if (!submenu) return;

            submenu.classList.toggle('hidden');
            const arrow = link.querySelector('.accordion-toggle');
            if (arrow) arrow.classList.toggle('rotate-90');
        });
    });
}
