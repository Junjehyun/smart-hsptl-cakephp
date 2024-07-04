/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.php',
    './src/**/*.php',
    './webroot/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        jp: ['Zen Maru Gothic', 'sans-serif'], // 日本語フォント
      },
    },
  },
  plugins: [],
}

