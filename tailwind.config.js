import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    '50': '#f0f6ff',
                    '100': '#e0edff',
                    '200': '#c8dfff',
                    '300': '#a3c9ff',
                    '400': '#7aa8ff',
                    '500': '#5582ff',
                    '600': '#2952e3',
                    '700': '#1b41cc',
                    '800': '#1634a3',
                    '900': '#152f81',
                    '950': '#04346E', // Warna asli Anda
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
