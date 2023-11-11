/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{php,js}",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: ["light", "dark", "cupcake"],
  },
  plugins: [
    require('flowbite/plugin'),
    require('daisyui')
  ]
}
