//TODO Admin's side - Applicants Alerts
//Administrator actions for Applicant's Saving prompt.

function handleAddNotesForm(response) {
    const review = response.review.notes;

    if(response.success) {
        Swal.fire({
            icon: 'success',
            title: `Note has been saved!`,
            text: `"${review}" has been added on the VA\'s note.`,
            showConfirmButton: false,
            allowOutsideClick: false,
            timerProgressBar: true,
            timer: 2500,
        });
    } else {
        let notesError = response.responseJSON.errors.notes;

        Swal.fire({
            icon: 'error',
            title: 'Error!',
            html:`
                <p>${response.responseJSON.message}</p>
                <p><strong>Notes:</strong> ${notesError}</p>
                `,
            showConfirmButton: false,
            allowOutsideClick: false,
            timerProgressBar: true,
            timer: 3000
        });
    }
}

function handleUpdateStatusForm(response) {
    const status = response.status.status;
    const LMS = response.status.lesson;
    const tier = response.tier.tier;

    if(response.success) {
        Swal.fire({
            icon: 'success',
            title: `Status Updated!`,
            html:`
                <ul class="text-left">
                    <ol><strong>Status:</strong> ${status}</ol>
                    <ol><strong>LMS:</strong> ${LMS}</ol>
                    <ol><strong>Notes:</strong> ${tier}</ol>
                </ul>
                <p>Status set successfully.</p>
            `,
            showConfirmButton: false,
            allowOutsideClick: false,
            timerProgressBar: true,
            timer: 2500,
        });
    }
}

function handleEditApplicantForm(response) {
    if(response.success) {
        const user = response.user.name;

        Swal.fire({
            icon: 'success',
            title: `${user}'s information updated!`,
            text: `Information has been updated successfully.`,
            showConfirmButton: false,
            timerProgressBar: true,
            allowOutsideClick: false,
            timer: 2500,
        });
    }
}

function handleProfileForm(response) {
    if(response.success) {
        const user = response.user.name;

        Swal.fire({
            icon: 'success',
            title: `${user}'s profile updated!`,
            text: `Profile changes has been saved accordingly.`,
            showConfirmButton: false,
            timerProgressBar: true,
            allowOutsideClick: false,
            timer: 2500,
        });
    }
}

function handleSkillsetForm(response) {
    if(response.success) {
        const skillset = response.skillsets;
        const skill = skillset.skill;
        const tool = skillset.tool;
        const website = skillset.website;
        const softskill = skillset.softskill;
        const user = response.user.name;

        Swal.fire({
            icon: 'success',
            title: `${user} skillsets are updated!`,
            html:`
            <p><strong>Skill:</strong> ${skill}</p>
            <p><strong>Tool:</strong> ${tool}</p>
            <p><strong>Website:</strong> ${website}</p>
            <p><strong>Softskill:</strong> ${softskill}</p>

            <p>Skillsets has been saved accordingly.</p>
            `,
            showConfirmButton: false,
            timerProgressBar: true,
            allowOutsideClick: false,
            timer: 2500,
        });
    }
}

function handleReferencesForm(response) {
    if(response.success) {
        Swal.fire({
            icon: 'success',
            title: `VA references updated!`,
            text: `References has been saved accordingly.`,
            showConfirmButton: false,
            allowOutsideClick: false,
            timerProgressBar: true,
            timer: 2500,
        });
    }
}

function handleUpdatePasswordForm(response) {
    if(response.success) {
        Swal.fire({
            icon: 'success',
            title: `VA password updated!`,
            text: `Password has been updated accordingly.`,
            showConfirmButton: false,
            allowOutsideClick: false,
            timerProgressBar: true,
            timer: 2500,
        });
    }
}

function handleAddExperienceForm(response) {
    if(response.success) {
        Swal.fire({
            icon: 'success',
            title: `VA Experience added!`,
            text: `${response.experience.title} has been added successfully.`,
            showConfirmButton: false,
            allowOutsideClick: false,
            timerProgressBar: true,
            timer: 2500,
        });
    }
}

function deleteExperienceForm(response) {
    if(response.success) {
        Swal.fire({
            icon: 'success',
            title: `VA Experience deleted!`,
            text: `${response.experience.title} has been deleted.`,
            showConfirmButton: false,
            allowOutsideClick: false,
            timerProgressBar: true,
            timer: 2500,
        });
    }
}

function handleEditFileForm(response) {
    if(response.success) {
        Swal.fire({
            icon: 'success',
            title: `File Updated!`,
            text: `File has been saved accordingly.`,
            showConfirmButton: false,
            timer: 2500,
        });
    }
}

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

function handleMockcallFormSubmission(response) {

    if(response.success) {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: 'Added mock call successfully... This will overwrite existing mock call files.',
            showConfirmButton: false,
            timerProgressBar: true,
            allowOutsideClick: false,
            timer: 3000
        });
    } else {
        let inboundError = response.responseJSON.errors.inbound_call ? response.responseJSON.errors.inbound_call : 'Correct File.';
        let outboundError = response.responseJSON.errors.outbound_call ? response.responseJSON.errors.outbound_call : 'Correct File.';

        Swal.fire({
            icon: 'error',
            title: 'Error!',
            html:`
                <p>${response.responseJSON.message}</p>
                <p><strong>Inbound:</strong> ${inboundError}</p>
                <p><strong>Outbound:</strong> ${outboundError}</p>
                `,
            showConfirmButton: false,
            timerProgressBar: true,
            allowOutsideClick: false,
            timer: 3000
        });
    }

}

function handleExperienceFormSubmission() {

    Swal.fire({
        title: 'Add more experiences?',
        html: `
                <p>Selecting "Exit" will close this modal.</p>
                <p>choosing "Add another experience" will add more details from previous job experiences.</p>
            `,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Exit',
        denyButtonText: 'Add another experience',
        confirmButtonColor: '#007afe',
        denyButtonColor: '#3ec2ee',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire({
            icon: 'info',
            title: 'Records saved!',
            text: 'Finished adding experience(s), closing this modal...',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 2000
            });
        } else if (result.isDenied) {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: 'Adding experience successful, re-opening modal...',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 2000
            });

            const createExperienceModal = new bootstrap.Modal(document.getElementById('create-details-modal'));
            createExperienceModal.show();

        }
    });
}

function handleReferencesFormSubmission() {
    Swal.fire({
        icon: 'success',
        title: 'Saving references...',
        text: 'Adding references, kindly wait a moment.',
        showConfirmButton: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        timer: 2000,
    });
}

function handleFormWithMissingField(formattedResponse) {
    let cleanBracketResponses = formattedResponse.replace(/^\[|\]$/g, '');
    let newlineResponses = cleanBracketResponses.replace(/,\s*/g, ',\n');
    let itemizeResponses = newlineResponses.split(',');

    let errorMessages = itemizeResponses.map(message => `<li>${message.trim()}</li>`).join('');

    Swal.fire({
        icon: 'error',
        title: 'Incomplete answers...',
        html: `
            <p><strong>'Please answer all of the question in the form.'</strong></p>
            <p class="mt-4">
                <ul class="text-left">
                    ${errorMessages}
                </ul>
            </p>
            `,
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: 2000,
    });
}

function handleReferencesWithMissingField(formattedResponse) {
    let cleanBracketResponses = formattedResponse.replace(/^\[|\]$/g, '');
    let newlineResponses = cleanBracketResponses.replace(/,\s*/g, ',\n');
    let itemizeResponses = newlineResponses.split(',');

    let errorMessages = itemizeResponses.map(message => `<li>${message.trim()}</li>`).join('');

    Swal.fire({
        icon: 'error',
        title: 'Incomplete answers...',
        html: `
            <p><strong>'Please answer all of the question in the form.'</strong></p>
            <p class="mt-4">
                <ul class="text-left">
                    ${errorMessages}
                </ul>
            </p>
            `,
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: 2000,
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


// !Sweet alert for users-end
//Add Virtual Agent Scores
function handleDashboardFormSubmission(form) {

    Swal.fire({
        icon: 'info',
        title: 'Are you sure?',
        html: `
            <p>Your answers will be evaluated by the management thoroughly...</p>
            <p>Make sure everything is accurate and final.</p>
        `,
        showCancelButton: true,
        confirmButtonColor: '#007afe',
        cancelButtonColor: '#6d747d',
        confirmButtonText: 'Yes, Submit!',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'info',
                title: 'Saving your Information!',
                html: `
                <p> Information is still saving, please wait a moment!</p>
                <p> This will overwrite previous responses if there are any. Please refrain from pressing any keys.</p>
                `,
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    form.submit();
                }
            })
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
                allowOutsideClick: false,

            });

        } else {
            Swal.fire({
            title: "Reset unsuccessful.",
            timer: 2000,
            icon: 'error',
            showConfirmButton: false,
            allowOutsideClick: false,

            });
        }
    });
}

//Invalid Skype
function invalidSkype() {
    Swal.fire({
        icon: 'warning',
        title: 'Warning!',
        html: `
            Please don\'t use the following to avoid <strong>"Not Following Instructions"</strong> penalty from the HR.
                <div class="text-left">
                    <p>- NA</p>
                    <p>- N/A</p>
                    <p>- n/a</p>
                    <p>- na</p>
                    <p>- none</p>
                    <p>- None</p>
                    <p>- NONE</p>
                </div>

            <p class="fst-italic">If you don't have one, please create before proceeding.</p>
            <p>Failure to do so, will result in a <strong><span class="text-danger">"FAILURE"</span></strong> of a submission by Human Resource.</p>
            `,
        showConfirmButton: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        timer: 5000,
    });
}
//Expand years of experience reminders.
function remindExpandExperience() {
    Swal.fire({
        icon: 'info',
        title: 'Click "Expand" Button',
        html: `
            <p>Please don\'t forget to click <strong>"Expand"</strong> in order to provide detail with experience. </p>
            <p>Make sure that total years of experience is equal to the experience's details</p>
            <p>Failure to do so, will result in a <strong><span class="text-danger">"FAILURE"</span></strong> of a submission by Human Resource.</p>
            `,
        showConfirmButton: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        timer: 8000,
    });
}
//Expand References reminders.
function reminderExpandReference() {
    Swal.fire({
        icon: 'info',
        title: 'Additional References',
        html: `
            <br>
            <p>Your video is added for submission!</p>
            <p>Please don\'t forget to click the button for <strong>"References"</strong>. </p>
            <p>Failure to do so, will result in a <strong><span class="text-danger">"FAILURE"</span></strong> of a submission by Human Resource.</p>
            `,
        showConfirmButton: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        timer: 8000,

    });
}
//Exceeding video file size reminders.
function reminderExceedingVideoSize(fileSizeMB) {
    const toFloatFileSizeMB = parseInt(fileSizeMB);
    Swal.fire({
        icon: 'warning',
        title: 'Video Size Exceeds Limit!',
        html: `
            <p>Please make sure that the video is below the <strong>maximum</strong> limit set! Please compress your video.</p>
            <br>
            <p>Your current video input is <strong> ${toFloatFileSizeMB}MB</strong>!</p>
            `,
        showConfirmButton: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        timer: 6000,

    });
}

//Exceeding file size reminders.
function reminderExceedingFileSize(fileSizeMB) {
    const toFloatFileSizeMB = parseInt(fileSizeMB);
    Swal.fire({
        icon: 'warning',
        title: 'File Size Exceeds Limit!',
        html: `
            <p>Please make sure that the file is below the <strong>maximum</strong> limit set! Please try again.</p>
            <br>
            <p>Your current file is <strong> ${toFloatFileSizeMB}MB</strong>!</p>
            `,
        showConfirmButton: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        timer: 6000,

    });
}
