import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        path.resolve(__dirname, "./resources/views/**/*.blade.php"),
        path.resolve(__dirname, "./resources/js/**/*.js"),
        path.resolve(__dirname, "./app/Http/Controllers/**/*.php"),
        path.resolve(__dirname, "./app/Livewire/**/*.php"),
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
                display: ['Outfit', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            colors: {
                brand: {
                    50: '#e8f0f8',
                    100: '#c5d9ed',
                    200: '#9fbfe0',
                    300: '#7aa5d3',
                    400: '#5b8ec7',
                    500: '#0e3558',
                    600: '#0c2d4c',
                    700: '#0a243d',
                    800: '#071a2e',
                    900: '#04101d',
                },
                accent: {
                    50: '#e6fafa',
                    100: '#b3f0f0',
                    200: '#80e6e6',
                    300: '#4ddbdc',
                    400: '#26d1d2',
                    500: '#00afb0',
                    600: '#009494',
                    700: '#007a7a',
                    800: '#005f60',
                    900: '#003d3d',
                },
                warm: {
                    50: '#fafaf9',
                    100: '#f5f5f4',
                    200: '#e7e5e4',
                    300: '#d6d3d1',
                    400: '#a8a29e',
                    500: '#78716c',
                    600: '#57534e',
                    700: '#44403c',
                    800: '#292524',
                    900: '#1c1917',
                },
                midnight: '#1a1a2e',
                gold: '#d4af37',
                'tech-cyan': '#00d4ff',
                'logo-yellow': '#f8b803',
            },
            boxShadow: {
                'accent': '0 4px 14px 0 rgba(0, 175, 176, 0.3)',
                'accent-hover': '0 6px 20px rgba(0, 175, 176, 0.45)',
                'yellow': '0 4px 14px 0 rgba(248, 184, 3, 0.3)',
            }
        },
    },
    plugins: [],
}
