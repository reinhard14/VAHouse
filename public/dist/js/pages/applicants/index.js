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

            // Submit the form, to sweetAlertJS.
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

    if (deleteCheckboxes) {
        deleteCheckboxes.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleDeleteConfirmation(form);
            });
        });
    }

    //saving admin applicants
    const form = document.getElementById('addApplicantsForm')

    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            handleApplicantsFormSubmission(form);
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

    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const toggleIcon = document.querySelector('#toggleIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute using getAttribute() and setAttribute()
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the icon
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    });

    document.querySelectorAll('.editTogglePassword').forEach(button => {
        button.addEventListener('click', function () {
            const editPassword = button.closest('.input-group').querySelector('.editPassword');
            const editToggleIcon = button.querySelector('.editToggleIcon');

            const type = editPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            editPassword.setAttribute('type', type);

            // Toggle the icon
            editToggleIcon.classList.toggle('bi-eye');
            editToggleIcon.classList.toggle('bi-eye-slash');
        });
    });



});

//Jquery
$(document).ready(function() {
    $('#websites').select2({
        maximumSelectionLength: 10,
        placeholder: 'Select websites..',
    });

    $('#tools').select2({
        maximumSelectionLength: 10,
        placeholder: 'Select tools..',
    });

    $('#skills').select2({
        maximumSelectionLength: 10,
        placeholder: 'Select skills..',
    });

    $('#softskills').select2({
        maximumSelectionLength: 10,
        placeholder: 'Select softskills..',
        // allowClear: true,
    });

    $('#experience').select2({
        maximumSelectionLength: 4,
        placeholder: 'Select Experience..',
    });

    $('#collapseOne').collapse('hide');

});
