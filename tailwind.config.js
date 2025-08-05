/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  safelist: [
    'bg-gradient-to-r',
    'from-purple-600',
    'to-pink-600',
    'hover:from-purple-700',
    'hover:to-pink-700',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
