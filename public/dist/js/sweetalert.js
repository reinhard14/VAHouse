//TODO Admin's side - Applicants Alerts
//Administrator actions for Applicant's Saving prompt.
function handleApplicantFormSubmission(form) {

    Swal.fire({
        icon: 'info',
        title: 'Saving!',
        text: 'Adding applicant...',
        showConfirmButton: false,
        timer: 2000,
        willClose: () => {
            form.submit();
        }
    });
}

// function handleExperienceFormSubmission() {

//     Swal.fire({
//         icon: 'success',
//         title: 'Saved!',
//         text: 'Adding experience successful...',
//         showConfirmButton: false,
//         timer: 2000
//     });
// }

function handleExperienceFormSubmission() {

    Swal.fire({
        title: 'Add more experiences?',
        text: 'Select "Exit" to return to dashboard, and select "Add another experience" to add more details from previous job experiences',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Exit',
        denyButtonText: 'Add another experience',
        confirmButtonColor: '#007afe',
        denyButtonColor: '#3ec2ee',
    }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: 'Adding experience successful...',
            showConfirmButton: false,
            timer: 2000
            });
        } else if (result.isDenied) {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: 'Adding experience successful...Re-opening modal',
            showConfirmButton: false,
            timer: 2000
            });

            const createExperienceModal = new bootstrap.Modal(document.getElementById('create-details-modal'));
            createExperienceModal.show();

        }
    });
}
//Administrator's actions for Applicant's prompt.
function handleApplicantEditFormSubmission(form) {

    Swal.fire({
        icon: 'info',
        title: 'Are you sure?',
        text: 'This will modify the applicant\'s current data...',
        showCancelButton: true,
        confirmButtonColor: '#007afe',
        cancelButtonColor: '#6d747d',
        confirmButtonText: 'Confirm!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: 'Saving!',
            text: 'Inserting applicant\'s data in the database...',
            icon: 'info',
            showConfirmButton: false,
        })
            setTimeout(() => {
                // Submit the form (triggering form submission)
                form.submit()
            }, 2000);
        };
    });
}

//Administrator's actions for updating Applicant's status.
function handleApplicantStatusUpdateSubmission(form) {

    Swal.fire({
        icon: 'info',
        title: 'Are you sure?',
        text: 'This will update the applicant\'s current status...',
        showCancelButton: true,
        confirmButtonColor: '#007afe',
        cancelButtonColor: '#6d747d',
        confirmButtonText: 'Confirm!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: 'Saving!',
            text: 'updating record in the database...',
            icon: 'info',
            showConfirmButton: false,
        })
            setTimeout(() => {
                // Submit the form (triggering form submission)
                form.submit()
            }, 2000);
        };
    });
}

// Generate Form Applicants Prompt
function generateApplicantsFormConfirmation() {
    Swal.fire({
    title: "Generate form",
    text: "Are you sure you want to generate this applicant's form?",
    icon: "Info",
    showCancelButton: true,
    confirmButtonColor: '#007afe',
    cancelButtonColor: '#6d747d',
    confirmButtonText: 'Generate',
    }).then((result) => {
        if (result.isConfirmed) {
        // If the user clicks "Yes, clear," clear the input fields
        const inputFields = document.querySelectorAll('input');

        inputFields.forEach((input) => {
            input.value = '';
        });

        Swal.fire({
            showConfirmButton: false,
            title: 'Please wait',
            text: 'Generating file...',
            icon: 'success',
            timer: 2000,
        });
        } else {
            Swal.fire({
            title: "Returning to applicant's form.",
            timer: 2000,
            icon: 'error',
            showConfirmButton: false,
            });
        }
    });
}

//TODO Department Alerts
//Edit Department
function handleEditDepartmentForm(editDepartmentForm) {
    Swal.fire({
        icon: 'success',
        title: 'Saved!',
        text: 'Department has been updated successfully.',
        showConfirmButton: false,
        timer: 2000,
        willClose: () => {
            editDepartmentForm.submit(); // Submit the form when the alert is closed
        }
    });
}

//TODO Departments alerts
//Add Department
function handleAddDepartmentForm(addDepartmentForm) {
    Swal.fire({
        icon: 'success',
        title: 'Saved!',
        text: 'Department has been successfully saved.',
        showConfirmButton: false,
        timer: 2000,
        willClose: () => {
            addDepartmentForm.submit(); // Submit the form when the alert is closed
        }
    });
}

//Delete confirm prompt
function handleDeleteConfirmation(form) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6d747d',
        confirmButtonText: 'Delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: 'Deleted!',
            text: 'Item has been deleted.',
            icon: 'success',
            showConfirmButton: false,
        })
            setTimeout(() => {
                // Submit the form (triggering form submission)
                form.submit()
            }, 2000);
        };
    });
}

//TODO Administrator Alerts
//Administrator Saving prompt.
function handleAdminFormSubmission(form) {
    const userChoiceInput = document.getElementById('savingOption')
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save and Exit',
        denyButtonText: 'Save and Add Another',
        confirmButtonColor: '#007afe',
        denyButtonColor: '#3ec2ee',
    }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire({
            title: 'Saving...',
            text: `Successful save will return to administrator's list.`,
            showConfirmButton: false,
            icon: 'info'
            });
            //setting hidden input value for route after saving.
            userChoiceInput.value = 'save_and_exit';

            setTimeout(() => {
                form.submit()
            }, 2000);
        } else if (result.isDenied) {
        Swal.fire({
            title: 'Saving...',
            showConfirmButton: false,
            icon: 'info',
            timer: 2000,
            });
            //setting hidden input value for route after saving.
            userChoiceInput.value = 'save_and_add_another';

            setTimeout(() => {
                form.submit()
            }, 2000);
        }
    });
}

//Administrator Updating prompt.
function handleAdminEditFormSubmission(updateForm, userRouteOption) {
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save and Exit',
        denyButtonText: 'Save and View changes',
        confirmButtonColor: '#007afe',
        denyButtonColor: '#3ec2ee',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Saving...',
                text: `Successful update will return to administrator's list.`,
                showConfirmButton: false,
                icon: 'info'
                });
                //setting hidden input value for route after saving.
                userRouteOption.value = 'save_and_exit';

                setTimeout(() => {
                    updateForm.submit()
                }, 2000);
        } else if (result.isDenied) {
            Swal.fire({
                title: 'Saving...',
                showConfirmButton: false,
                icon: 'info',
                timer: 2000,
                });
                //setting hidden input value for route after saving. change...
                userRouteOption.value = 'save_and_view';

                setTimeout(() => {
                    updateForm.submit()
                }, 2000);
        }
    });
}

// Reset Fields Prompt
function handleClearFields() {
    Swal.fire({
    title: "Clear Fields?",
    text: "Are you sure you want to clear all input fields?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6d747d',
    confirmButtonText: 'Clear!',
    }).then((result) => {
        if (result.isConfirmed) {
        // If the user clicks "Yes, clear," clear the input fields
        const inputFields = document.querySelectorAll('input');

        inputFields.forEach((input) => {
            input.value = '';
        });

        Swal.fire({
            showConfirmButton: false,
            title: 'Field reset!',
            text: 'Reset of field confirmed',
            icon: 'success',
            timer: 2000,
        });
        } else {
            Swal.fire({
            title: "Reset unsuccessful.",
            timer: 2000,
            icon: 'error',
            showConfirmButton: false,
            });
        }
    });
}

// //Administrator Edit prompt.
// function editAdministratorFormSubmission(form) {
//     Swal.fire({
//         icon: 'info',
//         title: 'Are you sure?',
//         text: 'This will update the administrator\'s information.',
//         showCancelButton: true,
//         confirmButtonColor: '#007afe',
//         cancelButtonColor: '#6d747d',
//         confirmButtonText: 'Yes, Submit!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             Swal.fire({
//             title: 'Updating!',
//             text: 'The information for the administrator is being saved at the database.',
//             icon: 'success',
//             showConfirmButton: false,
//         })
//             setTimeout(() => {
//                 form.submit()
//             }, 2000);
//         };
//     });
// }


// !Sweet alert for users-end
//Add Virtual Agent Scores
function handleDashboardFormSubmission(form) {

    Swal.fire({
        icon: 'info',
        title: 'Are you sure?',
        text: 'Your answers will be evaluated by the management thoroughly, make sure everything is accurate and final.',
        showCancelButton: true,
        confirmButtonColor: '#007afe',
        cancelButtonColor: '#6d747d',
        confirmButtonText: 'Yes, Submit!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            icon: 'info',
            title: 'Applicant Information!',
            text: 'Information being saved, please wait a moment! this will overwrite previous responses if there are any.',
            showConfirmButton: false,
        })
            setTimeout(() => {
                form.submit()
            }, 2000);
        };
    });
}

// Reset Fields Prompt
function handleClearFields() {
    Swal.fire({
    title: "Clear All Fields?",
    text: "Are you sure you want to clear all input fields?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6d747d',
    confirmButtonText: 'Clear!',
    }).then((result) => {
        if (result.isConfirmed) {
            const select2Fields = document.querySelectorAll('.select2');
            const inputFields = document.querySelectorAll('input');

            select2Fields.forEach((select) => {
                $(select).val(null).trigger('change');
            });
            inputFields.forEach((input) => {
                input.value = '';
                input.checked = false;
            });

            Swal.fire({
                showConfirmButton: false,
                title: 'Field reset!',
                text: 'Reset of field confirmed',
                icon: 'success',
                timer: 2000,
            });

        } else {
            Swal.fire({
            title: "Reset unsuccessful.",
            timer: 2000,
            icon: 'error',
            showConfirmButton: false,
            });
        }
    });
}
