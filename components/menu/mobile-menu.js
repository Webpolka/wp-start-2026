export function initMobileMenu() {
    const burger = document.getElementById("burgerBtn");
    const menu = document.getElementById("mobileMenu");
    const closeBtn = document.getElementById("closeMenu");

    if (!burger || !menu || !closeBtn) return;

    // Инициализация ARIA
    burger.setAttribute("aria-expanded", "false");
    burger.setAttribute("aria-controls", "mobileMenu");
    menu.setAttribute("role", "navigation");
    menu.setAttribute("aria-hidden", "true");

    function openMenu() {
        menu.classList.remove("translate-x-full");
        menu.classList.add("translate-x-0");
        document.body.style.overflow = "hidden";
        burger.setAttribute("aria-expanded", "true");
        menu.setAttribute("aria-hidden", "false");
    }

    function closeMenu() {
        menu.classList.add("translate-x-full");
        menu.classList.remove("translate-x-0");
        document.body.style.overflow = "";
        burger.setAttribute("aria-expanded", "false");
        menu.setAttribute("aria-hidden", "true");

        // Закрываем все подменю
        menu.querySelectorAll('.submenu').forEach(ul => ul.classList.add('hidden'));
        menu.querySelectorAll('.accordion-toggle').forEach(arrow => arrow.classList.remove('rotate-90'));
    }

    // Toggle меню по кнопке бургер
    burger.addEventListener("click", () => {
        const isOpen = menu.classList.contains("translate-x-0");
        if (isOpen) closeMenu();
        else openMenu();
    });

    // Закрытие по кнопке закрытия
    closeBtn.addEventListener("click", closeMenu);

    // Закрытие по клику вне меню
    menu.addEventListener("click", e => {
        if (e.target === menu) closeMenu();
    });

    // Закрытие по Esc
    document.addEventListener("keydown", e => {
        if (e.key === "Escape") closeMenu();
    });

    // Подменю (аккордеоны)
    menu.querySelectorAll('.menu-item-has-children > a').forEach(link => {
        link.addEventListener('click', e => {
            if (window.innerWidth >= 768) return; // Только для мобильных
            e.preventDefault();

            const submenu = link.parentElement.querySelector(':scope > .submenu');
            if (!submenu) return;

            submenu.classList.toggle('hidden');
            const arrow = link.querySelector('.accordion-toggle');
            if (arrow) arrow.classList.toggle('rotate-90');
        });
    });
}
