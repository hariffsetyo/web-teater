import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            colors: {
                maroon: {
                    50: '#FDF2F4',
                    100: '#FBE8EB',
                    200: '#F5C6CE',
                    300: '#EFA4B1',
                    400: '#E36077',
                    500: '#B8233C',
                    600: '#8B1E2D',
                    700: '#6B1220',
                    800: '#5B0F1A',
                    900: '#3D0A11',
                    950: '#230509',
                },
                gold: {
                    50: '#FCF9EE',
                    100: '#F9F2D8',
                    200: '#F1D77A',
                    300: '#E9C752',
                    400: '#DEB93E',
                    500: '#D4AF37',
                    600: '#B08D23',
                    700: '#8A6C18',
                    800: '#664F12',
                    900: '#47360C',
                },
                stage: {
                    black: '#0D0B0C',
                    dark: '#141113',
                    card: '#1C1719',
                    surface: '#241E21',
                    border: '#362E32',
                    muted: '#8C8287',
                },
                parchment: {
                    50: '#FDFCFA',
                    100: '#F5EBD7',
                    200: '#EBD8B8',
                    300: '#DFC296',
                    400: '#CCA872',
                    500: '#B58E55',
                    800: '#4E3A20',
                    900: '#2F2313',
                },
            },
            fontFamily: {
                sans: ['Inter', 'Poppins', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', 'Georgia', 'serif'],
                dramatic: ['Cinzel', '"Playfair Display"', 'serif'],
            },
            boxShadow: {
                'gold-glow': '0 0 25px rgba(212, 175, 55, 0.25)',
                'gold-lg': '0 0 40px rgba(212, 175, 55, 0.35)',
                'maroon-glow': '0 0 30px rgba(91, 15, 26, 0.5)',
                'stage': '0 10px 40px -10px rgba(0, 0, 0, 0.8)',
            },
            backgroundImage: {
                'spotlight-radial': 'radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(212, 175, 55, 0.12) 0%, rgba(91, 15, 26, 0.06) 35%, transparent 70%)',
                'curtain-pattern': 'repeating-linear-gradient(90deg, #5B0F1A 0px, #7A1423 20px, #5B0F1A 40px, #3D0A11 60px)',
            },
            animation: {
                'curtain-left': 'curtainLeft 1.4s cubic-bezier(0.77, 0, 0.175, 1) forwards',
                'curtain-right': 'curtainRight 1.4s cubic-bezier(0.77, 0, 0.175, 1) forwards',
                'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'float': 'float 6s ease-in-out infinite',
            },
            keyframes: {
                curtainLeft: {
                    '0%': { transform: 'scaleX(1)' },
                    '100%': { transform: 'scaleX(0)' },
                },
                curtainRight: {
                    '0%': { transform: 'scaleX(1)' },
                    '100%': { transform: 'scaleX(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
            },
        },
    },

    plugins: [forms],
};