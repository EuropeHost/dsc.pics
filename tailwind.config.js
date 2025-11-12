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
                'dscpics': {
                    50: '#F5F7FA',
                    100: '#E1E8F0',
                    200: '#C7D1DC',
                    300: '#A4B4C4',
                    400: '#7F93A7',
                    500: '#5C7186',
                    600: '#405263',
                    700: '#2E3D4A',
                    800: '#1D2A33',
                    900: '#10191F',
                    950: '#0B1115',
                },
                'dscpics-500': '#57abff',
            },
        },
    },

    plugins: [forms, typography],
};