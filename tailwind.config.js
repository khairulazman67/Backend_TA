const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary:{
                    600 : '#96B197',
                    700 : '#85AB86',
                    800 : '#74A074',
                    900 : '#69926A'
                },
                secondary:{
                    300 : '#FFD6E8',
                    800 : '#D74F8A',
                    900 : '#BA3670'
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
