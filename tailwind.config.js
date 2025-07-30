/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './app/**/*.php',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './public/*.html',
  ],
  theme: {
    extend: {
      colors: {
        // Zuppie Brand Colors
        'zuppie': {
          50: '#f5f3ff',
          100: '#ede9fe',
          200: '#ddd6fe',
          300: '#c4b5fd',
          400: '#a78bfa',
          500: '#8b5cf6',  // Primary purple
          600: '#7c3aed',
          700: '#6d28d9',
          800: '#5b21b6',
          900: '#4c1d95',
          950: '#2e1065',
        },
        'zuppie-pink': {
          50: '#fdf2f8',
          100: '#fce7f3',
          200: '#fbcfe8',
          300: '#f9a8d4',
          400: '#f472b6',
          500: '#ec4899',  // Primary pink
          600: '#db2777',
          700: '#be185d',
          800: '#9d174d',
          900: '#831843',
          950: '#500724',
        },
        // Event Package Colors
        'package': {
          'birthday': {
            50: '#fff7ed',
            500: '#f97316',
            600: '#ea580c',
          },
          'wedding': {
            50: '#fef2f2',
            500: '#ef4444',
            600: '#dc2626',
          },
          'corporate': {
            50: '#f0f9ff',
            500: '#3b82f6',
            600: '#2563eb',
          },
          'anniversary': {
            50: '#f5f3ff',
            500: '#8b5cf6',
            600: '#7c3aed',
          },
        },
        // UI Colors
        'success': {
          50: '#f0fdf4',
          500: '#22c55e',
          600: '#16a34a',
        },
        'warning': {
          50: '#fffbeb',
          500: '#f59e0b',
          600: '#d97706',
        },
        'error': {
          50: '#fef2f2',
          500: '#ef4444',
          600: '#dc2626',
        },
        'info': {
          50: '#eff6ff',
          500: '#3b82f6',
          600: '#2563eb',
        },
      },
      fontFamily: {
        'sans': ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        'display': ['Poppins', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      animation: {
        'float': 'float 4s ease-in-out infinite',
        'float-slow': 'float-slow 6s ease-in-out infinite',
        'float-slower': 'float-slower 8s ease-in-out infinite',
        'float-gentle': 'float-gentle 10s ease-in-out infinite',
        'bounce-soft': 'bounce-soft 3s ease-in-out infinite',
        'pulse-slow': 'pulse-glow 2.5s ease-in-out infinite',
        'sparkle': 'sparkle 2s ease-in-out infinite',
        'fade-in-up': 'fadeInUp 0.6s ease-out',
        'typewriter': 'typing 2s steps(40, end), blink 1s step-end infinite',
      },
      keyframes: {
        float: {
          '0%': { transform: 'translateY(0px) rotate(0deg)' },
          '33%': { transform: 'translateY(-30px) rotate(-2deg)' },
          '66%': { transform: 'translateY(-20px) rotate(2deg)' },
          '100%': { transform: 'translateY(0px) rotate(0deg)' },
        },
        'float-slow': {
          '0%': { transform: 'translateY(0px) rotate(0deg)' },
          '33%': { transform: 'translateY(-25px) rotate(1deg)' },
          '66%': { transform: 'translateY(-15px) rotate(-1deg)' },
          '100%': { transform: 'translateY(0px) rotate(0deg)' },
        },
        'float-slower': {
          '0%': { transform: 'translateY(0px) rotate(0deg)' },
          '33%': { transform: 'translateY(-20px) rotate(-1deg)' },
          '66%': { transform: 'translateY(-10px) rotate(1deg)' },
          '100%': { transform: 'translateY(0px) rotate(0deg)' },
        },
        'float-gentle': {
          '0%': { transform: 'translateY(0px) translateX(0px) rotate(0deg)' },
          '25%': { transform: 'translateY(-15px) translateX(5px) rotate(1deg)' },
          '50%': { transform: 'translateY(-10px) translateX(-3px) rotate(-0.5deg)' },
          '75%': { transform: 'translateY(-20px) translateX(2px) rotate(0.5deg)' },
          '100%': { transform: 'translateY(0px) translateX(0px) rotate(0deg)' },
        },
        'bounce-soft': {
          '0%, 100%': { transform: 'translateY(0px) scale(1)' },
          '50%': { transform: 'translateY(-12px) scale(1.05)' },
        },
        'pulse-glow': {
          '0%, 100%': { opacity: '0.7', boxShadow: '0 0 10px rgba(255, 255, 255, 0.3)' },
          '50%': { opacity: '1', boxShadow: '0 0 20px rgba(255, 255, 255, 0.5)' },
        },
        sparkle: {
          '0%, 100%': { opacity: '1', transform: 'scale(1)' },
          '50%': { opacity: '0.8', transform: 'scale(1.1)' },
        },
        fadeInUp: {
          from: { opacity: '0', transform: 'translate3d(0, 40px, 0)' },
          to: { opacity: '1', transform: 'translate3d(0, 0, 0)' },
        },
        typing: {
          from: { width: '0' },
          to: { width: '100%' },
        },
        blink: {
          '50%': { borderColor: 'transparent' },
        },
      },
      backgroundImage: {
        'gradient-primary': 'linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%)',
        'gradient-secondary': 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        'gradient-rainbow': 'linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%)',
      },
      boxShadow: {
        'glow': '0 0 30px rgba(139, 92, 246, 0.4)',
        'glow-pink': '0 0 30px rgba(236, 72, 153, 0.4)',
        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
      },
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
        '128': '32rem',
      },
    },
  },
  plugins: [],
}
