/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{php,js}"
  ],
  
  theme: {
    extend: {},
  },
  daisyui: {
    themes: ["light", "dark", "cupcake"],
  },
  plugins: [require("daisyui")],
}
