document.addEventListener("DOMContentLoaded", function() {

    const checkboxDeleteButton = document.getElementById('checkboxDeleteButton');
    const deleteForm = document.getElementById('deleteForm');
    const deleteViewForm = document.getElementById('deleteViewForm');
    const deleteItemCheckboxes = document.querySelectorAll('.deleteItemCheckboxes');
    const deleteMasterCheckbox = document.getElementById('deleteMasterCheckbox');
    const selectedAdminIdsInput = document.getElementById("selectedAdminIds");
    //deleting admin on index.
    const deleteForms = document.querySelectorAll('.deleteAdminForm');
    //deleting admin on index.
    const deleteCheckboxes = document.querySelectorAll('.deleteCheckboxes');
    //saving admin form, and routing admin.
    const form = document.getElementById('routeAdminForm')
    //Update admin form, and routing admin.
    const updateForm = document.getElementById('routeAdminEditForm');
    const userRouteOption = document.getElementById('savingOption');
    //resetting admin fields.
    const resetFieldButton = document.getElementById('resetFieldButton');

    let checkedCheckboxCounter = 0;
    const selectedAdminIds = [];


    function checkboxChecker(checkbox) {
        let limitCheckboxCount = deleteItemCheckboxes.length;

        if (checkbox.checked) {
            checkboxDeleteButton.disabled = false;
            checkedCheckboxCounter++;

            //Don't add to array if element is existing.
            if (!selectedAdminIds.includes(checkbox.getAttribute("data-admin-id"))) {
                // console.log(selectedAdminIds + " does not have " + checkbox.getAttribute("data-admin-id"));
                selectedAdminIds.push(checkbox.getAttribute("data-admin-id"));
            }

            //limiting the checkbox count
            if (checkedCheckboxCounter >= limitCheckboxCount) {
                checkedCheckboxCounter = limitCheckboxCount;
                deleteMasterCheckbox.checked = true;
            }
            // debugger
            // console.log('yes. ' + checkedCheckboxCounter)
            // console.log(selectedAdminIds);
        } else if (!checkbox.checked && checkedCheckboxCounter > 1) {
            checkboxDeleteButton.disabled = false;
            deleteMasterCheckbox.checked = false;
            checkedCheckboxCounter--;
            selectedAdminIds.pop(checkbox);
            // console.log(selectedAdminIds);
            // // debugger
            // // console.log('not gone yet. ' + checkedCheckboxCounter)
        } else {
            checkboxDeleteButton.disabled = true;
            checkedCheckboxCounter = 0;
            selectedAdminIds.pop(checkbox);
            deleteMasterCheckbox.checked = false;
            // console.log(selectedAdminIds);
            // // debugger
            // console.log('none');
        }
    };

    //TODO -- EVENT HANDLERS
    //Individual checkboxes
    if (deleteItemCheckboxes) {
        deleteItemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                checkboxChecker(checkbox);

            });
        });
    }

    //Master checkbox
    if (deleteMasterCheckbox) {
        deleteMasterCheckbox.addEventListener('change', () => {
            if (deleteMasterCheckbox.checked) {
                deleteItemCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    checkboxChecker(checkbox);
                });
            } else {
                deleteItemCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                    checkboxChecker(checkbox);
                });
            }
        });
    }

    //Multiple delete Form Submission.
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(event) {
            event.preventDefault();

            // Collect the selected administrator IDs
            const selectedAdminIds = Array.from(deleteItemCheckboxes)
                                        .filter(checkbox => checkbox.checked)
                                        .map(checkbox => checkbox.getAttribute("data-admin-id"));

            // Set the value of the input field
            selectedAdminIdsInput.value = selectedAdminIds.join(",");

            // Submit the form, from sweetAlertJS.
            handleDeleteConfirmation(deleteForm);
        });
    }

    if (deleteViewForm) {
        deleteViewForm.addEventListener('submit', function(event) {
            event.preventDefault();
            handleDeleteConfirmation(deleteViewForm);
        });
    }

    //deleting admin on index.
    if (deleteForms) {
        deleteForms.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleDeleteConfirmation(form);
            });
        });
    }

    //deleting admin on index.
    if (deleteCheckboxes) {
        deleteCheckboxes.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleDeleteConfirmation(form);
            });
        });
    }

    //saving admin form, and routing admin.
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            handleAdminFormSubmission(form);
        });
    }

    //Update admin form, and routing admin.
    if (updateForm && userRouteOption) {
        updateForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleAdminEditFormSubmission(updateForm, userRouteOption);
        });
    }

    //resetting admin fields.
    if (resetFieldButton) {
        resetFieldButton.addEventListener('click', (e) => {
            e.preventDefault();
            handleClearFields();
        });
    }

});
