import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import persist from '@alpinejs/persist';

Alpine.plugin(intersect);
Alpine.plugin(persist);

window.Alpine = Alpine;

// Initialize Alpine if not already started
if (!window.AlpineStarted) {
    window.AlpineStarted = true;
    Alpine.start();
}