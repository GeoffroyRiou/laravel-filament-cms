import 'virtual:svg-icons-register'
import initRGPD from './rgpd';
import initSliders from './sliders';
import initScrollAnimations from './scrollAnimation';
import Alpine from 'alpinejs'
 
window.Alpine = Alpine
 
Alpine.start();

window.addEventListener('load', () => {
    initRGPD();
    initSliders();
    initScrollAnimations();
});