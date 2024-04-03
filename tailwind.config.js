/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      screens: {
        'xs': '475px', // Extra small screens, mobile phones
        'sm': '640px', // Small screens, mobile phones
        'md': '768px', // Medium screens, tablets
        'lg': '1024px', // Large screens, laptops
        'xl': '1280px', // Extra large screens, desktops
        '2xl': '1536px', // Extra extra large screens, 2k monitors and above
      },
    },
  },
  plugins: [],
}