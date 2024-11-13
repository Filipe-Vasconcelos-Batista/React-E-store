/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./index.html",
      "./src/**/*.{html,js,ts,tsx,jsx}"
  ],
  theme: {
    extend: {
        fontFamily:{
            sans:['Roboto', 'sans-serif'],
        },
        gridTemplateColumns: {
            '70/30':'70% 28',
        }
    },
  },
  plugins: [],
}
