import 'virtual:svg-icons-register'
import initRGPD from './rgpd';
import initMainMenu from './main-menu';
import initSliders from './sliders';
import initScrollAnimations from './scrollAnimation';

window.addEventListener('load', () => {
    initRGPD();
    initMainMenu();
    initSliders();
    initScrollAnimations();
});