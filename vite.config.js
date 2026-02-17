import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
import tailwindcss from '@tailwindcss/vite'
import { fileURLToPath } from 'url'
import path from 'path'
import fs from 'fs'

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

const config = JSON.parse(
  fs.readFileSync('./dev.config.json', 'utf-8')
)

export default defineConfig({
  resolve: {
    alias: {
      // для абсолютных импортов от корня темы
      "@": path.resolve(__dirname, './'),
      '@assets': path.resolve(__dirname, './assets/src'),
      '@components': path.resolve(__dirname, './components'),
      '@icons': path.resolve(__dirname, './assets/src/icons'),
      '@images': path.resolve(__dirname, './assets/src/images')
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
    open: config.siteUrl,  // открывать браузер на этом адресе
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
