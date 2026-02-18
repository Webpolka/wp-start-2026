import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
import tailwindcss from '@tailwindcss/vite'
import { fileURLToPath } from 'url'
import path from 'path'
import dotenv from 'dotenv';
dotenv.config();

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

const SITE_URL = process.env.SITE_URL || "http://localhost/wordpress";

export default defineConfig({
  resolve: {
    alias: {
      // для абсолютных импортов от корня темы
      "@": path.resolve(__dirname, './'),   
    }
  },

  // Плагины
  plugins: [
    tailwindcss(),
    // авто-перезагрузка браузера при изменении PHP файлов
    liveReload(['**/*.php'])
  ],

  //  DEV сервер (когда npx vite)
  server: {
    open: SITE_URL,        // открывать браузер на этом адресе
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
