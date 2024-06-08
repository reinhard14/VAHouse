
//Form Adding
const addFormModal = document.getElementById('addFormModal');

if(addFormModal) {
    addFormModal.addEventListener('submit', function (e) {
        e.preventDefault();
        handleAddForm(addFormModal);
    });
}

//Form Editing
const editFormModal = document.querySelectorAll('.editFormModal');

if(editFormModal) {
    editFormModal.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            handleUpdateForm(form);
        });
    });
}

//Form Deleting
const formDelete = document.querySelectorAll('.formDelete')

if(formDelete) {
    formDelete.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            handleDeleteConfirmation(form);
        });
    })
}

//Input Deletion
const inputDelete = document.querySelectorAll('.inputDelete')

if(inputDelete) {
    inputDelete.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            handleDeleteConfirmation(form);
        });
    })
}

const addInputModal = document.getElementById('addInputModal');

if (addInputModal) {
    addInputModal.addEventListener('submit', function (e) {
        e.preventDefault();
        handleAddInputForm(addInputModal);
    })
}

// TODO working version okay?

const collapseFormIcons = document.querySelectorAll('.bi.bi-box-arrow-in-up-left');

if (collapseFormIcons) {

    collapseFormIcons.forEach((collapseFormIcon) => {

        const formId = collapseFormIcon.getAttribute('data-form-id');
        const collapse = document.getElementById(`collapseForm${formId}`);

            //default icon set
            if (!collapse.classList.contains('show')) {
                collapseFormIcon.classList.remove('bi-box-arrow-in-up-left');
                collapseFormIcon.classList.add('bi-box-arrow-in-down-right');
            }

            if (collapse) {
                collapse.addEventListener('hidden.bs.collapse', () => {
                    collapseFormIcon.classList.remove('bi-box-arrow-in-up-left');
                    collapseFormIcon.classList.add('bi-box-arrow-in-down-right');
                });

                collapse.addEventListener('shown.bs.collapse', () => {
                    collapseFormIcon.classList.remove('bi-box-arrow-in-down-right');
                    collapseFormIcon.classList.add('bi-box-arrow-in-up-left');
                });
            }

    });

}


//finish the javascript for input/ additional input, check input.js.
//goodnight
