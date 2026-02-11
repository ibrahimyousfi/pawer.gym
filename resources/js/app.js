import './bootstrap';

import Alpine from 'alpinejs';

// Create a global store for sidebar state
Alpine.store('sidebar', {
    open: localStorage.getItem('sidebarOpen') !== 'false',
    
    toggle() {
        this.open = !this.open;
        localStorage.setItem('sidebarOpen', this.open);
    }
});

window.Alpine = Alpine;

Alpine.start();
