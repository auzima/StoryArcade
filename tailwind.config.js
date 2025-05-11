import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    darkMode: 'class', // active le mode sombre via la classe "dark"

    content: [
        './resources/**/*.blade.php',
        './resources/**/*.vue',
        './resources/**/*.js',
        './resources/views/**/*.blade.php', // juste au cas où
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Optionnel : ajoute des couleurs pastel personnalisées
                lilas: '#d8b4fe',
                rose: '#f9a8d4',
            }
        },
    },

    plugins: [forms],
};