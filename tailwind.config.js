/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        'blogh': ['Blogh', 'sans-serif'],
        'americane': ['Americane', 'sans-serif'],
      },
      colors : {
        'pamo-noir' : '#00001C',
        'pamo-jaune' : '#FFD527',
        'pamo-rose' : '#FF3797',
        'pamo-bleu' : '#2226F7',
        'pamo-vert' : '#24D56D',
      },
      boxShadow : {
        'jaune' : '-6px 0 0 #FFD527, 6px 0 0 #FFD527',
        'rose' : '-6px 0 0 #FF3797, 6px 0 0 #FF3797',
        'vert' : '-6px 0 0 #24D56D, 6px 0 0 #24D56D',
      },
      maxWidth: {
        'container': '1440px',
        'container-small': '1160px'
      },
      borderRadius: {
        'lvl2' : '34px'
      }
    },
  },
  plugins: [],
}

