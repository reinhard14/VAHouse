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
    const deleteFromForm = document.querySelectorAll('.deleteItemPrompt');

    //deleting admin on index.
    if (deleteFromForm) {
        deleteFromForm.forEach((form) => {
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
            handleApplicantFormSubmission(form);
        });
    }

    const editUserForm = document.querySelectorAll('.editUserForm');

    if (editUserForm) {
        editUserForm.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleApplicantEditFormSubmission(form);
            })
        })
    }
    const editApplicantStatus = document.querySelectorAll('.editApplicantStatus');

    if(editApplicantStatus) {
        editApplicantStatus.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleApplicantStatusUpdateSubmission(form);
            })
        })
    }

    //for add applicant modal
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

    //for edit applicant modal
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

//JQuery
$(document).ready(function() {
    // select2
    $('#websites, #tools, #skills, #softskills, #experiences, #statuses, #tiers, #LMS').select2({
        maximumSelectionLength: 15,
        placeholder: function() {
            return $(this).data('placeholder');
        },
    });

    //Default - Show the filters and hide sidebar
    $('#collapseOne').collapse('show');

    $('#collapseServicesOffered').collapse('hide');
    $('#collapseTitles').collapse('hide');

    $('.sidebar-mini').addClass('sidebar-collapse')

    //for edit applicants module
    $('.skillsets, .positions, .services').select2({
        tags: true,
        tokenSeparators: ',',
        placeholder: 'Please select from choices..',
        width: '100%',
    });

    //auto resize long modals
    $('.modal.long').on('shown.bs.modal', function () {
        $(this).find('.modal-body').css({
            'max-height': '400px',
            'overflow-y': 'auto'
        });
    });

});
