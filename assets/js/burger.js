function toggleMenu() {
    const menu = document.querySelector('.burger');
    const burgerLogo = document.querySelector('.burgerLogo');
    const burgerHiden = document.querySelector('.burgerHiden')
    menu.classList.toggle('active');

    if (menu.classList.contains('active')) {
        burgerLogo.style.display = 'none'; 
        burgerHiden.style.display = 'block'; 
    } else {
        burgerLogo.style.display = 'block'; 
        burgerHiden.style.display = 'none'; 
    }
}
