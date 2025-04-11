import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


if(document.querySelector('.pop-up-create')){

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

//Checkbox all toggle

document.addEventListener("DOMContentLoaded", () => {
    if(document.querySelector('.checkbox-all')){
        const checkboxAll = document.querySelector('.checkbox-all');
        const checkboxes = document.querySelectorAll('.checkbox');
        const deleteBtn = document.querySelector('.delete-btn');

        const checkedValues = new Set();

        // Function to update the delete button state
        const updateButtonState = () => {

            const idsArray = Array.from(checkedValues);
            document.getElementById('checked-ids').value = JSON.stringify(idsArray);

            deleteBtn.disabled = !document.querySelector('.checkbox:checked');
        };

        // Function to handle checkbox change
        const handleCheckboxChange = (event) => {
            if (event.target.checked) {
                checkedValues.add(event.target.value);
            } else {
                checkedValues.delete(event.target.value);
            }
            console.log([...checkedValues]);
            updateButtonState();
        };

        // Handle "Select All" checkbox change
        checkboxAll.addEventListener('change', () => {
            const isChecked = checkboxAll.checked;
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
                isChecked ? checkedValues.add(checkbox.value) : checkedValues.delete(checkbox.value);
            });
            console.log([...checkedValues]);
            updateButtonState();
        });

        // Add event listeners to all checkboxes
        checkboxes.forEach(checkbox => checkbox.addEventListener('change', handleCheckboxChange));

        // Initialize button state
        updateButtonState();
    }
});
    


