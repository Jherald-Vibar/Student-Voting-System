module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      extend: {
      },
      fontFamily:{
        body:['Poppins']
      }
    },
    plugins: [
        require('flowbite/plugin')
    ],


  }
