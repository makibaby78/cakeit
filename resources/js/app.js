import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


if(document.querySelector('.pop-up-create')){
    console.log("test")

    const create = document.querySelectorAll('.pop-up-create');

    popUp( create );

}


function popUp( trigger ) {

    const popupContent = document.querySelector('.pop-up-wrapper');
    const btnClosePopup = document.querySelectorAll('.close-pop');

    trigger.forEach((item, index)=>{
        item.addEventListener('click', (e) => {
            e.preventDefault();
            popupContent.classList.add('open');
        })
    });

    btnClosePopup.forEach((item, index)=>{
        item.addEventListener('click', (e) => {
            e.preventDefault();
            popupContent.classList.remove('open');
        })
    });
}