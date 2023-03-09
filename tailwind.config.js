/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans'],
            },
            colors: {
                danger: colors.rose,
                primary: colors.sky,
                success: colors.green,
                warning: colors.yellow,
                gray: colors.gray,
            },
        },

    },
    darkMode: 'class',
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
}
