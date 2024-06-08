document.addEventListener("DOMContentLoaded", function() {
    // document.addEventListener('click', function(e){
    //     console.log(e.target);
    // });

    const formType = document.getElementById('formType');
    const option = document.getElementById('option');
    const addOptionButton = document.getElementById('addOption');
    const removeOptionButton = document.getElementById('removeOption');
    const inputContainer = document.getElementById('inputContainer');


    function disableModalElements() {
        option.disabled = true;
        addOptionButton.disabled = true;
        removeOptionButton.disabled = true;

        const addedOption = document.querySelectorAll('.addedOption');

        addedOption.forEach(option => {
            option.disabled = true;
        });
        addOptionButton.disabled = true;
    }

    function enableModalElements() {
        //input remove button disables.
        option.disabled = false;
        addOptionButton.disabled = false;
        removeOptionButton.disabled = false;

        const addedOption = document.querySelectorAll('.addedOption');

        addedOption.forEach(option => {
            option.disabled = false;
        });

        addOptionButton.disabled = false;
    }

     //ADD OPTION BUITTON
    function handleAddOptionBtnClk() {
        // Create a new input element
        const newInput = document.createElement('input');

        newInput.classList.add('addedOption', 'form-control', 'mb-2');
        newInput.type = 'text';
        newInput.name = 'option';
        newInput.id = 'option';
        newInput.placeholder = 'Additional option...';

        //append to inputContainer.
        inputContainer.appendChild(newInput);

        // Check and disable addOptionButton if formType is not radio or checkbox
        const selectedValue = formType.value;
        if (selectedValue !== 'radio' && selectedValue !== 'checkbox') {
            disableModalElements();
        }
    }

    function handleFormTypeChange(e) {
        const selectedValue = e.target.value;

        if (selectedValue !== 'radio' && selectedValue !== 'checkbox') {
            disableModalElements();
        } else {
            enableModalElements();
        }
    }

    //REMOVE OPTION BUTTON
    function handleRemoveOptionBtnClk() {
        const existingInputs = 3;

        if (inputContainer.childNodes.length > existingInputs) {
            inputContainer.removeChild(inputContainer.lastChild);
        }
    }

    //OBSERVE CHANGES ON MODAL,based in Input Type.
    formType.addEventListener('change', handleFormTypeChange);
    addOptionButton.addEventListener('click', handleAddOptionBtnClk);
    removeOptionButton.addEventListener('click', handleRemoveOptionBtnClk);


    // TODO
    // // 1 dapat nako ma butang ang adding sa
    // // ilalum sa newly added na element
    // // 2 disabled sab dapat ang adding element kung dli selected ang
    // // radio ug checkbox
    // 3 ang array upon saving sa option sa blade view.show
    // 4 fix controller to accomodate multiple options.
    //limit extra options(?)
    //goodnight.
    // // Learn event delegation. stuck on dynamically added inputs.
    // // stuck sa input. disabling additional option, which is dynamically added.fnd way.
});
