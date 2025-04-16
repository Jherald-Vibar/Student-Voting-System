module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      extend: {
        fontFamily: {
          body: ['Poppins'],
        },
        keyframes: {
          'fade-in': {
            '0%': { opacity: '0' },
            '100%': { opacity: '1' },
          },
          'slide-in-down': {
            '0%': { transform: 'translateY(-20px)', opacity: '0' },
            '100%': { transform: 'translateY(0)', opacity: '1' },
          },
          'fade-in-up': {
            '0%': { opacity: '0', transform: 'translateY(10px)' },
            '100%': { opacity: '1', transform: 'translateY(0)' },
          },
          'bounce-slow': {
            '0%, 100%': { transform: 'translateY(0)' },
            '50%': { transform: 'translateY(-5px)' },
          },
        },
        animation: {
          'fade-in': 'fade-in 0.8s ease-out both',
          'slide-in-down': 'slide-in-down 0.7s ease-out both',
          'fade-in-up': 'fade-in-up 0.7s ease-out both',
          'bounce-slow': 'bounce-slow 2s infinite',
        },
      },
    },
    plugins: [
      require('flowbite/plugin')
    ],
  }
