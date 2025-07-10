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

document.addEventListener('alpine:init', () => {
    Alpine.data('productCheckout', (config) => ({
        selectedMembers: config.maxMembers || 4,
        basePrice: config.basePrice || 0,
        maxMembers: config.maxMembers || 4,
        groupDiscount: config.groupDiscount || 0.20, // diskon 20% untuk grup penuh

        get fullGroupPrice() {
            return this.basePrice * (1 - this.groupDiscount);
        },

        get pricePerMember() {
            if (this.selectedMembers >= this.maxMembers) {
                return this.fullGroupPrice / this.maxMembers;
            }
            // Harga lebih mahal jika anggota kurang dari maksimal
            const penaltyFactor = (this.maxMembers - this.selectedMembers) * 0.10; // penalti 10% per anggota yg kurang
            return this.basePrice * (1 + penaltyFactor);
        },

        get totalPrice() {
            return this.pricePerMember * this.selectedMembers;
        },

        formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }
    }));
});

Alpine.start();
