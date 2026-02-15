import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'

export default defineConfig({

  // Плагины
  plugins: [
    // авто-перезагрузка браузера при изменении PHP файлов
    liveReload(['**/*.php'])
  ],

  //  DEV сервер (когда npx vite)
  server: {
    host: 'localhost',     // откуда грузится vite
    port: 5173,            // порт dev сервера
    strictPort: true,      // не прыгать на другой порт
    cors: true,            // разрешаем WP грузить vite (иначе CORS ошибка)

    hmr: {
      host: 'localhost'    // hot reload (обновление без F5)
    }
  },

  // BUILD (npm run build)
  build: {
    outDir: 'assets/dist', // куда складывается билд
    emptyOutDir: true,     // очищать папку перед билдом
    manifest: true,        // создаёт manifest.json для WP

    rollupOptions: {
      // главный входной файл (из него тянется sass, tailwind, js)
      input: 'assets/src/js/main.js'
    }
  }

})
