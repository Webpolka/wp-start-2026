export function initMobileMenu() {
const burger = document.getElementById("burgerBtn");
    const menu = document.getElementById("mobileMenu");
    const closeBtn = document.getElementById("closeMenu");

    if (!burger || !menu || !closeBtn) return;

    // ARIA
    burger.setAttribute("aria-expanded", "false");
    burger.setAttribute("aria-controls", "mobileMenu");
    menu.setAttribute("role", "navigation");
    menu.setAttribute("aria-hidden", "true");

    // Функции открытия/закрытия меню
    const openMenu = () => {
        menu.classList.remove("translate-x-full");
        menu.classList.add("translate-x-0");
        document.body.style.overflow = "hidden";
        burger.setAttribute("aria-expanded", "true");
        menu.setAttribute("aria-hidden", "false");
    };

    const closeMenu = () => {
        menu.classList.add("translate-x-full");
        menu.classList.remove("translate-x-0");
        document.body.style.overflow = "";
        burger.setAttribute("aria-expanded", "false");
        menu.setAttribute("aria-hidden", "true");

        // Закрываем подменю
        menu.querySelectorAll(".submenu").forEach(ul => ul.classList.add("hidden"));
        menu.querySelectorAll(".accordion-toggle").forEach(arrow => arrow.classList.remove("rotate-90"));
    };

    // Toggle бургер
    burger.addEventListener("click", () => menu.classList.contains("translate-x-0") ? closeMenu() : openMenu());
    closeBtn.addEventListener("click", closeMenu);

    // Клик вне меню закрывает его
    menu.addEventListener("click", e => { if (e.target === menu) closeMenu(); });

    // Esc закрывает меню
    document.addEventListener("keydown", e => { if (e.key === "Escape") closeMenu(); });

    // Закрытие меню при ресайзе (переход на десктоп)
    window.addEventListener("resize", () => { if (window.innerWidth >= 768) closeMenu(); });

    // Подменю на мобильке (аккордеоны)
    menu.querySelectorAll(".menu-item-has-children > a").forEach(link => {
        link.addEventListener("click", e => {
            if (window.innerWidth >= 768) return;
            e.preventDefault();
            const submenu = link.parentElement.querySelector(":scope > .submenu");
            if (!submenu) return;
            submenu.classList.toggle("hidden");

            // Анимация стрелки
            const arrow = link.querySelector(".accordion-toggle");
            arrow?.classList.toggle("rotate-90");
        });
    });

    // Десктоп: добавление focus для accessibility
    menu.querySelectorAll(".menu-item-has-children").forEach(li => {
        li.addEventListener("focusin", () => li.classList.add("focus"));
        li.addEventListener("focusout", () => li.classList.remove("focus"));
    });

    // Optional: плавная анимация подменю через Tailwind
    menu.querySelectorAll(".submenu").forEach(ul => {
        ul.classList.add("transition-all", "duration-300", "ease-in-out");
    });
}
