/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // поддержка тёмной темы через класс .dark
  content: [
    './*.php',
    './template-parts/**/*.php',    
    "./components/**/*.{php,html,js}"
  ],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '16px',
        sm: '20px',
        lg: '24px',
        xl: '32px',
        '2xl': '40px',
      },
      screens: {
        sm: '640px',
        md: '768px',
        lg: '1024px',
        xl: '1280px',
        '2xl': '1440px',
      },
    },
    extend: {
      colors: {
        white: '#fff',
        black: '#000',
      },
      fontFamily: {
        // кастомные шрифты для body и heading
        body: ['Roboto', 'sans-serif'],
        heading: ['Montserrat', 'sans-serif'],
      },
      maxWidth: {
        container: '1440px',
      },
      transitionProperty: {
        'height-opacity': 'height, opacity',
      },
    },
  },
  plugins: [],
}
