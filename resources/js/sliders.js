// import Swiper JS
import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

// import Swiper styles
import 'swiper/css';


const initSliders = () => {
    new Swiper('.home-hero__slider', {
        slidesPerView: 3,
        spaceBetween: 20,
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 480px
            640: {
                slidesPerView: 6
            },
            // when window width is >= 640px
            1024: {
                slidesPerView: 10,
            }
        }
    });

    new Swiper('.cms-team__slider', {
        modules: [Navigation],
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        centerInsufficientSlides: true,
        slidesPerView: 2,
        spaceBetween: 20,
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 480px
            640: {
                slidesPerView: 3
            },
            // when window width is >= 640px
            1024: {
                slidesPerView: 5,
            }
        }
    });
}

export default initSliders;