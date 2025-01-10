
import Lenis from '@studio-freight/lenis'
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

const MOBILE_LIMIT = 768;

/**
 * Initialise le smooth scroll
 */
const initLenisScroll = () => {

    // Initialisation
    const lenis = new Lenis({
        lerp: 0.1, // Plu sla valeur est basse plus le scroll est doux
        smoothWheel: true // Activation du smooth pour le scroll à la roulette
    });

    // Mise à jour du scroll gsap
    lenis.on('scroll', ScrollTrigger.update)

    // Appel de lenis à chaque animation frame
    const scrollFn = (time) => {
        lenis.raf(time);
        requestAnimationFrame(scrollFn);
    };
    requestAnimationFrame(scrollFn);
}

const initScrollAnimations = () => {

    initLenisScroll();
    initWorkWork();
}

export default initScrollAnimations;


const initWorkWork = () => {
    
    const wrapper = document.querySelector(".home-visuels .inner");

    if (!wrapper) return;


    const tween = gsap.to(wrapper, {
        x: getScrollAmount(wrapper),
        duration: 3,
        ease: "none",
    });

    ScrollTrigger.create({
        //trigger: ".home-visuels",
        start: window.innerHeight /2,
        end: () => `+=${getScrollAmount(wrapper) * -1}`,
        pin: true,
        animation: tween,
        scrub: 1,
        invalidateOnRefresh: true
    })
}

function getScrollAmount(element) {
    let elementWidth = element.scrollWidth;
    return -(elementWidth - window.innerWidth );
}