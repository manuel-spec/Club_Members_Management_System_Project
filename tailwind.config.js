/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/css/*.{html,js}",
    './*.{html,js,php}',
    './views/*.{html,js,php}',
    './views/admin/*.{html,js,php}'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

