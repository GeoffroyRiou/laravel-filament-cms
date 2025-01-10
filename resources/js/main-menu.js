

const initMainMenu = () => {
    const togglers = document.querySelectorAll('.main-menu-toggler');
    const mainMenu = document.querySelector('.main-menu');
    const mainHeader = document.querySelector('.main-header__logo');
    
    if (!mainMenu  || !mainHeader  || !togglers.length) return;


    observer.observe(mainHeader)

    togglers.forEach(el => {
        el.addEventListener('click', (ev) => {
            ev.preventDefault();
            mainMenu.classList.toggle('-active');
        });
    })
}

const observer = new IntersectionObserver((entries) => {

    const burger = document.querySelector('.main-header__burger');

    entries.forEach((entry) => {
        if(entry.boundingClientRect.top > 0)
            burger.classList.remove('-stick');
        else
            burger.classList.toggle('-stick');
    });
},{
    rootMargin: "0px",
    threshold: .1,
});

export default initMainMenu;