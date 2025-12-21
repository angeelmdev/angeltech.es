/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: true,
  important: true,
  content: [
    "./templates/**/*.{html,twig}",
    "./assets/**/*.{js,ts}",
    "./src/**/*.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
