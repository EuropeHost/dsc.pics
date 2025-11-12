import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dscpics: {
                    50: '#F0F9FF',
                    100: '#E0F2FE',
                    200: '#BAE6FD',
                    300: '#7DD3FC',
                    400: '#38BDF8',
                    500: '#0EA5E9',
                    600: '#0284C7',
                    700: '#0369A1',
                    800: '#075985',
                    900: '#0C4A6E',
                    950: '#082F49',
                },
            },
            spacing: {
                30: '7.5rem', // 120px
            },
        },
    },

    plugins: [
        forms,
        typography,
        function ({ addBase, theme }) {
            addBase({
                '::selection': {
                    backgroundColor: theme('colors.dscpics.400'),
                    color: theme('colors.white'),
                },
                '.dark ::selection': {
                    backgroundColor: theme('colors.dscpics.600'),
                    color: theme('colors.white'),
                },
            });
        },
    ],
};