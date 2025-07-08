import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Logika untuk Theme Switcher
document.addEventListener('alpine:init', () => {
    Alpine.data('themeSwitcher', () => ({
        dark: localStorage.getItem('dark') === 'true',
        toggleTheme() {
            this.dark = !this.dark;
            localStorage.setItem('dark', this.dark);
        }
    }));
});

Alpine.start();