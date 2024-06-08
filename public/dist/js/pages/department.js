document.addEventListener("DOMContentLoaded", function() {

    const checkboxDeleteButton = document.getElementById('checkboxDeleteButton');
    const deleteItemCheckboxes = document.querySelectorAll('.deleteItemCheckboxes');
    const deleteMasterCheckbox = document.getElementById('deleteMasterCheckbox');

    let checkedCheckboxCounter = 0;
    const selectedDepartmentsIds = [];


    function checkboxChecker(checkbox) {
        let limitCheckboxCount = deleteItemCheckboxes.length;

        if (checkbox.checked) {
            checkboxDeleteButton.disabled = false;
            checkedCheckboxCounter++;

            //Don't add to array if element is existing.
            if (!selectedDepartmentsIds.includes(checkbox.getAttribute("data-department-id"))) {
                selectedDepartmentsIds.push(checkbox.getAttribute("data-department-id"));
            }

            if (checkedCheckboxCounter >= limitCheckboxCount) {
                checkedCheckboxCounter = limitCheckboxCount;
                deleteMasterCheckbox.checked = true;
            }

        } else if (!checkbox.checked && checkedCheckboxCounter > 1) {
            checkboxDeleteButton.disabled = false;
            deleteMasterCheckbox.checked = false;
            checkedCheckboxCounter--;
            selectedDepartmentsIds.pop(checkbox);

        } else {
            checkboxDeleteButton.disabled = true;
            checkedCheckboxCounter = 0;
            selectedDepartmentsIds.pop(checkbox);
            deleteMasterCheckbox.checked = false;
        }
    };

    function masterCheckbox() {
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
    }
    // * -- EVENT HANDLERS
    //Individual checkboxes
    deleteItemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            checkboxChecker(checkbox);
        });
    });

    //Master checkbox
    if (deleteMasterCheckbox) {
        deleteMasterCheckbox.addEventListener('change', masterCheckbox);
    }

    //Deleting department on index.
    const deleteDepartmentForms = document.querySelectorAll('.deleteDepartmentForm');

    if(deleteDepartmentForms) {
        deleteDepartmentForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleDeleteConfirmation(form);
            });
        });
    }

    // Add new department.
    const addDepartmentForm = document.getElementById('addDepartmentForm');

    if(addDepartmentForm) {
        addDepartmentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleAddDepartmentForm(addDepartmentForm);
        });
    }

    // Edit department.
    const editDepartmentForm = document.querySelectorAll('.editDepartmentForm');

    if(editDepartmentForm) {
        editDepartmentForm.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                handleEditDepartmentForm(form);
            })
        });

    }

    //Selected checkbox deletion and Form Submission.
    const deleteForm = document.getElementById('deleteForm');
    const selectedDepartmentIdsInput = document.getElementById("selectedDepartmentIds");

    deleteForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Collect the selected administrator IDs
        const selectedDepartmentIds = Array.from(deleteItemCheckboxes)
                                    .filter(checkbox => checkbox.checked)
                                    .map(checkbox => checkbox.getAttribute("data-department-id"));

        // Set the value of the input field
        selectedDepartmentIdsInput.value = selectedDepartmentIds.join(",");

        // Submit the form, from sweetAlertJS.
        handleDeleteConfirmation(deleteForm);
    });


});
