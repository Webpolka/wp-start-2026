export function initDarkMode() {
    const btns = document.querySelectorAll('.dark-mode-toggle');
    if (!btns || btns.length === 0) return;

    btns.forEach(btn => {
        const lightIcon = btn.dataset.lightIcon;
        const darkIcon = btn.dataset.darkIcon;

        // Иконка при загрузке
        btn.textContent = document.documentElement.classList.contains('dark') ? darkIcon : lightIcon;

        btn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');

            // Меняем иконку на всех кнопках одновременно
            btns.forEach(b => {
                b.textContent = document.documentElement.classList.contains('dark') ? darkIcon : lightIcon;
            });

            // Сохраняем выбор
            localStorage.setItem(
                'theme',
                document.documentElement.classList.contains('dark') ? 'dark' : 'light'
            );
        });
    });

    // Восстановление темы при загрузке
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
        btns.forEach(btn => {
            btn.textContent = btn.dataset.darkIcon;
        });
    }
}
