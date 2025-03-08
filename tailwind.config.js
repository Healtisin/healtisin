import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                styrene: ['__styreneA_403256', '__styreneA_Fallback_403256', 'sans-serif']
            },
            colors: {
                'primary': '#24b0ba',
                'primary-hover': '#73c7e3',
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
