document.addEventListener("DOMContentLoaded", function() {

    const checkboxDeleteButton = document.getElementById('checkboxDeleteButton');
    const deleteItemCheckboxes = document.querySelectorAll('.deleteItemCheckboxes');
    const deleteMasterCheckbox = document.getElementById('deleteMasterCheckbox');
    const selectedUserIdsInput = document.getElementById("selectedUserIds");


    let checkedCheckboxCounter = 0;
    const selectedUserIds = [];


    function checkboxChecker(checkbox) {
        let limitCheckboxCount = deleteItemCheckboxes.length;

        if (checkbox.checked) {
            checkboxDeleteButton.disabled = false;
            checkedCheckboxCounter++;

            //Don't add to array if element is existing.
            if (!selectedUserIds.includes(checkbox.getAttribute("data-admin-id"))) {
                selectedUserIds.push(checkbox.getAttribute("data-admin-id"));
            }

            //limiting the checkbox count
            if (checkedCheckboxCounter >= limitCheckboxCount) {
                checkedCheckboxCounter = limitCheckboxCount;
                deleteMasterCheckbox.checked = true;
            }

        } else if (!checkbox.checked && checkedCheckboxCounter > 1) {
            checkboxDeleteButton.disabled = false;
            deleteMasterCheckbox.checked = false;
            checkedCheckboxCounter--;
            selectedUserIds.pop(checkbox);

        } else {
            checkboxDeleteButton.disabled = true;
            checkedCheckboxCounter = 0;
            selectedUserIds.pop(checkbox);
            deleteMasterCheckbox.checked = false;
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

    const deleteForm = document.getElementById('deleteForm');

    //Multiple delete Form Submission.
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(event) {
            event.preventDefault();

            // Collect the selected administrator IDs
            const selectedUserIds = Array.from(deleteItemCheckboxes)
                                        .filter(checkbox => checkbox.checked)
                                        .map(checkbox => checkbox.getAttribute("data-admin-id"));

            // Set the value of the input field
            selectedUserIdsInput.value = selectedUserIds.join(",");

            // Submit the form, from sweetAlertJS.
            handleDeleteConfirmation(deleteForm);
        });
    }

    const deleteViewForm = document.getElementById('deleteViewForm');

    if (deleteViewForm) {
        deleteViewForm.addEventListener('submit', function(event) {
            event.preventDefault();
            handleDeleteConfirmation(deleteViewForm);
        });
    }

    //deleting user on index.
    const deleteForms = document.querySelectorAll('.deleteAdminForm');

    //deleting admin on index.
    if (deleteForms) {
        deleteForms.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleDeleteConfirmation(form);
            });
        });
    }

    //deleting user on index.
    const deleteCheckboxes = document.querySelectorAll('.deleteCheckboxes');

    //deleting user on index.
    if (deleteCheckboxes) {
        deleteCheckboxes.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleDeleteConfirmation(form);
            });
        });
    }

    //saving admin form, and routing admin.
    const form = document.getElementById('addUserForm')

    //saving admin form, and routing admin.
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            handleUserFormSubmission(form);
        });
    }

    const editUserForm = document.querySelectorAll('.editUserForm');

    if (editUserForm) {
        editUserForm.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleUserEditFormSubmission(form);
            })
        })
    }

});
