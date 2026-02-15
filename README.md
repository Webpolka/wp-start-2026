
# WP Starter Theme (Tailwind + Sass + Hot Reload)

Стартовая тема для WordPress с Tailwind CSS 3, Sass, Vite и поддержкой Hot Reload для PHP и JS.

Идеально подходит для разработки своих тем быстро и с современным стеком.


## Структура проекта

```
root/
├── assets/
│   └── src/
│       ├── icons/
│       │   ├── collection/
│       │   └── sprite/
│       ├── JS/
│       │   └── main.js
│       ├── CSS/
│       │   └── styles.scss
│       └── tailwind/
│           ├── input.css
│           └── output.css
│
├── components/
│   ├── dark-mode-toggle/
│   │   ├── darkmode-toggle.js
│   │   └── darkmode-toggle.php
│   └── menu/
│       ├── desktop-menu.js
│       ├── desktop-menu.php
│       ├── mobile-menu.js
│       └── mobile-menu.php
│
├── node_modules/
│   └── (устанавливаемые пакеты npm)
│
├── templateparts/
│   └── (пока пусто)
│
├── README.md
├── package.json
├── functions.php
├── index.php
├── header.php
├── footer.php
├── styles.scss
├── tailwind.config.js
├── vite.config.js
└── sprite-rebuild.js
```

Dev: Vite запускает сервер с Hot Reload для JS, Sass и Tailwind, плюс liveReload для PHP.
Build: Vite собирает всё в assets/dist с manifest.json для WordPress.

---

## ⚡ Быстрый старт

1. Склонируйте или скачайте репозиторий в папку `wp-content/themes/` вашего WordPress.

2. **Установите зависимости:**

```
npm install
```
Это установит Tailwind, Vite, Sass и другие пакеты для разработки.

Запуск в режиме разработки:
```
npm run dev
```

Tailwind автоматически компилирует CSS при изменении классов.

Vite следит за JS и PHP и делает Hot Reload (обновление без F5).

Вы видите изменения в браузере сразу.

Сборка для продакшена:
```
npm run build
```
Создаётся готовый CSS и JS в assets/dist.

Генерируется manifest.json для WordPress.

Генерация SVG спрайта:
```
npm run sprite
```
Берёт все SVG из assets/src/icons/collection.

Создаёт sprite.svg и symbol.html в assets/src/icons/sprite.

Можно вставлять иконки в тему через:


Конфиги

tailwind.config.js
Определяет, где искать классы Tailwind (content).

Настройка тёмной темы (darkMode: 'class').

Контейнеры, брейкпоинты, кастомные цвета и шрифты.

Минимизирует CSS, оставляя только нужные классы.

vite.config.js
Настройка dev сервера с Hot Reload для JS, Sass и PHP.

Плагин vite-plugin-live-reload обновляет браузер при изменении PHP.

Определяет сборку (build) в assets/dist для продакшена.

Как использовать
Добавляйте свои стили в styles.scss и компоненты Tailwind в input.css.

Пишите JS в main.js или создавайте свои компоненты в components/.

Добавляйте SVG иконки в assets/src/icons/collection, затем генерируйте спрайт через npm run sprite.

