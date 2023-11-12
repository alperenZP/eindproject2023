/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./index.php', 'connect.php', './src/**/*.{html,js,php}',],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: ["light", "dark", "cupcake"],
  },
}

