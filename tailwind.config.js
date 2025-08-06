/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './resources/**/*.php',
  ],
  safelist: [
    {
      pattern: /^bg-gradient-to-(r|l|t|b|tr|tl|br|bl)$/,
      variants: ['hover', 'focus', 'active']
    },
    {
      pattern: /^from-(purple|pink)-[0-9]+$/,
      variants: ['hover', 'focus', 'active']
    },
    {
      pattern: /^to-(purple|pink)-[0-9]+$/,
      variants: ['hover', 'focus', 'active']
    },
    {
      pattern: /^(inline-flex|items-center|justify-center)$/,
    },
    {
      pattern: /^text-/,
      variants: ['hover', 'focus', 'active']
    },
    {
      pattern: /^(px|py)-[0-9]+$/,
    },
    {
      pattern: /^rounded/,
    },
    {
      pattern: /^(font|text)-(normal|medium|semibold|bold)$/,
    },
    {
      pattern: /^(transform|transition|duration|ease)-/,
    },
    {
      pattern: /^scale-/,
      variants: ['hover', 'focus', 'active']
    },
    {
      pattern: /^shadow/,
      variants: ['hover', 'focus', 'active']
    },
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
