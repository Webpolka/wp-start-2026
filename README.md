
# WP Starter Theme (Tailwind 4 + Sass + Hot Reload) 2026

Стартовая тема для WordPress с Tailwind 4, CSS 3, Sass, Vite и поддержкой Hot Reload для PHP и JS.
Идеально подходит для разработки своих тем быстро и с современным стеком.

## Структура проекта

```
root/
├── dev-scripts/
│   ├── font-builder.js            # конвертация шрифтов из ttf и otf в woff2
│   ├── pot-builder.js             # генерация .pot .po .mo для переводов (парсит все файлы и собирает все фразы по проекту) 
│   ├── README-POT.md              # инструкция по настройке для xampp и windows 10 ( необходим WP-CLI глобально !!! )
│   ├── svg-sprite-builder.js      # генерация спратов svg
│   └── start-dev.js               # автостарт локалхоста, если локальный сервер запущен 
│
├── assets/
│   ├── dist/
│   │    ├── .vite/    
│   │    │    └── manifest.json    # файль с путями к чанкам билда (генерируется vite)
│   │    └── assets/               # чанки билда
│   │
│   └── src/
│       ├── fonts/                 # шрифты
│       │   ├── WOFF2              # сюда попадают сконвертированные шрифты
│       │   ├── шрифт-1.ttf        # шрифт для конвертации .ttf
│       │   ├── шрифт-2.otf        # шрифт для конвертации .otf
│       │   └── ...
│       │    
│       ├── icons/
│       │   ├── collection/        # исходные SVG для спрайта
│       │   └── sprite/            # сгенерированный SVG спрайт и html документ для визуализации спрайтов по ID
│       │   
│       ├── images/                # изображения
│       │   
│       ├── js/
│       │   └── main.js            # главный JS-файл проекта (входная точка)
│       ├── scss/
│       │   ├── basic.scss         # какието стиди для основных или кастомных классов 
│       │   ├── fonts.scss         # подключение шрифтов (генерируеться при команде npm run fonts)
│       │   ├── woocommerce.scss   # какие-то стили для woocommerce
│       │   └── main.scss          # главный SCSS, собирает в себе остальные scss 
│       │ 
│       └── tailwind.css           # исходный Tailwind
│          
│          
│
├── components/                    # кастомные компоненты
│   ├── dark-mode-toggle/          # переключатель темы (темная/светлая)
│   │   ├── darkmode-toggle.js
│   │   └── darkmode-toggle.php
│   └── menu/                      # менюшка
│       ├── desktop-menu.js
│       ├── desktop-menu.php
│       ├── mobile-menu.js
│       └── mobile-menu.php
│
├── inc/                           # инклуды
│   └── template-tags.php          
│
├── languages/                     # файлы для перевод (мультиязычность)
│   ├── en_US.po                   
│   ├── en_US.mo
│   ├── ru_RU.po                   
│   ├── ru_RU.mo
│   └── wp_start_2026.pot          # основной шаблон .pot
│
├── node_modules/
│   └── ... (устанавливаемые пакеты npm)
│
├── template-parts/
│   └── ... (шаблоны контента для страниц)
│
├── utils/
│   └── ... (разные утилиты для проекта)
│
├── dev.config.js        # дев конфиг ( ЗДЕСЬ НУЖНО УКАЗАТЬ ПУТЬ К ПРОЕКТУ НА LOCALHOST !!! )
├── .gitignore           # файл исключений для гит-хаб
├── jsconfig.json        # нужен для VS-Code, для корректной обработки путей при дополнении
├── README.md            # полезный файл с информацией
├── package.json         # пакет зависимостей
├── functions.php        # основной исполнительный файл wordpress
├── index.php
├── header.php
├── footer.php
├── ...
├── styles.scss          # без стилей (нужен для админки)
└── vite.config.js       # оосновной конфиг vite 

```


---
## Dev: Быстрый старт
Vite запускает сервер с Hot Reload для JS, Sass и Tailwind, плюс liveReload для PHP.

1.Склонируйте или скачайте репозиторий в папку `wp-content/themes/` вашего WordPress.

2.Установите зависимости:

```bash
npm install
```
Это установит Tailwind, Vite, Sass и другие пакеты для разработки.

3.В файле jsconfig.json укажи путь к сайту на локалхост, например:

```bash
http://localhost/папка-с-сайтом
```

4.Запуск в режиме разработки:

```bash
npm run dev
```
Tailwind автоматически компилирует CSS при изменении классов. Vite следит за JS и PHP и делает Hot Reload (обновление без F5). Вы видите изменения в браузере сразу.


---
## Build: 
в файле wp-config.php добавите константу WP_ENV с флагом production и Vite собирает всё в assets/dist с manifest.json для WordPress.

```php
define( 'WP_ENV', 'production' );
```

Сборка для продакшена:

```bash
npm run build
```
Создаётся готовый CSS и JS в assets/dist. Генерируется manifest.json для WordPress. 
--- 


## vite.config.js

    Настройка dev сервера с Hot Reload для JS, Sass и PHP.
    Плагин vite-plugin-live-reload обновляет браузер при изменении PHP.
    Определяет сборку (build) в assets/dist для продакшена.

---

## Поддержка алиасов 

- В проекте настроены **алиасы** через Vite, поэтому можно писать импорты от корня проекта:

```js
import { initDarkMode } from '@/components/dark-mode/dark-mode';
import { initDesktopMenu } from '@/components/menu/desktop-menu';
```

---
## Поддерживается ECMAScript синтаксис:

```js
import / export
```

стрелочные функции, деструктуризация, шаблонные строки и др.
---

Пишите JS в main.js или создавайте свои компоненты в components/.
Добавляйте SVG иконки в assets/src/icons/collection, затем генерируйте спрайт через npm run sprite.

## === SVG SPRITE BUILDER ============================================

Этот скрипт автоматически собирает все SVG-иконки из папки `icons/collection` в **один спрайт** и создаёт примерную HTML-страницу для просмотра.

---

## Как это работает

1. **Исходники SVG**  
   - Все SVG файлы кладутся в папку:
     ```
     assets/src/icons/collection/
     ```
   - Можно хранить и подпапки — скрипт обработает все SVG внутри.

2. **Сборка спрайта**  
   - Скрипт объединяет все SVG в один файл спрайт:
     ```
     assets/src/icons/sprite/sprite.svg
     ```
   - Для каждого `<symbol>` генерируется ID, совпадающий с именем файла.  
   - Создаётся пример HTML:
     ```
     assets/src/icons/sprite/symbol.html
     ```
     на котором можно посмотреть все иконки.

---

## Использование

В терминале, находясь в корне проекта, запустите:

```bash
npm run sprite
```

    После выполнения вы увидите сообщение:
    SVG спрайт успешно создан в assets/src/icons/sprite

## Использование в WordPress

Для удобного использования иконок в папке utils создана небольшая функция svg_icon, которая принимает ID иконки и классы Tailwind:

```bash
<?php
/**
 * Выводит SVG иконку из спрайта темы.
 *
 * @param string $icon_id ID иконки в спрайте (например, 'burger')
 * @param string $classes CSS классы для SVG (Tailwind или свои)
 */
function svg_icon($icon_id, $classes = '') {
    $sprite_url = get_template_directory_uri() . '/assets/src/icons/sprite/sprite.svg';

    echo '<svg class="' . esc_attr($classes) . '">';
    echo '<use href="' . esc_url($sprite_url) . '#' . esc_attr($icon_id) . '"></use>';
    echo '</svg>';
}

```

Функция подключена в файле functions.php:

```bash
include_once get_template_directory() . '/utils/svg.php';

```

## Пример использования в шаблоне

```bash
<?php svg_icon('burger', 'w-6 h-6 fill-current text-blue-500'); ?>
```



## ===  FONTS BUILDER ============================================

Этот скрипт позволяет автоматически конвертировать шрифты и генерировать SCSS-файл для подключения шрифтов в проекте.  
Он работает **без Gulp**, только через Node и npm.

---

## Как это работает

1. **Исходники шрифтов**  
   - OTF и TTF файлы кладутся в папку:  
     ```
     assets/src/fonts/
     ```
2. **Конвертация**  
   - Скрипт конвертирует OTF → TTF (если есть OTF файлы)  
   - TTF → WOFF2  
   - Все WOFF2 файлы помещаются в папку:
     ```
     assets/src/fonts/WOFF2/
     ```

3. **Генерация SCSS**  
   - Создаётся или перезаписывается файл:
     ```
     assets/src/scss/fonts.scss
     ```
   - В SCSS автоматически прописываются все шрифты с правильным весом (`Regular`, `Medium`, `Bold`, ...) и стилем (`normal`, `italic`).  
   - Имена файлов и font-weight вычисляются автоматически, точно как в оригинальном скрипте.

---

## Использование

В терминале, находясь в корне проекта, просто запустите:

```bash
npm run fonts
```

## ===  POTS BUILDER ============================================

Для того чтобы данный скрипт отработал у вас должен быть глобально установлен WP-CLI !!! 

## Подробнее -> .dev-scripts/README-POTS.md

В терминале:

```bash
npm run pot
```

POT → languages/wp_start_2026.pot

PO → languages/ru_RU.po и languages/en_US.po

MO → languages/ru_RU.mo и languages/en_US.mo

создает корректные шаблоны файлов готовые для взаимодействия с плагинами для переводов на разные языки (RU/EN).