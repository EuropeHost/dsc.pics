import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'dscpics': {
                    50: '#f0f9ff',    // Placeholder
                    100: '#e0f2fe',   // Placeholder
                    200: '#bae6fd',   // Placeholder
                    300: '#7dd3fc',   // Placeholder
                    400: '#38bdf8',   // Placeholder
                    500: '#0ea5e9',   // Placeholder
                    600: '#0284c7',   // Placeholder
                    700: '#0369a1',   // Placeholder
                    800: '#075985',   // Placeholder
                    900: '#0c4a6e',   // Placeholder
                    950: '#082f49',   // Placeholder
                },
            },
        },
    },

    plugins: [forms],
};
