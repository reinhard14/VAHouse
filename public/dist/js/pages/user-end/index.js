document.addEventListener("DOMContentLoaded", function() {
    //Submitting scores field.
    const form = document.getElementById('scoresForm')
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            handleDashboardFormSubmission(form);
        });
    }

    //Resetting applicant's fields.
    const resetFieldButton = document.getElementById('resetFieldButton');

    if (resetFieldButton) {
        resetFieldButton.addEventListener('click', (e) => {
            e.preventDefault();
            handleClearFields();
        });
    }

    const guidelinesModal = new bootstrap.Modal(document.getElementById('guidelinesModal'));
    guidelinesModal.show();

    const callers = document.getElementById('position3');
    const portfolio = document.getElementById('portfolio');

    callers.addEventListener('click', (e) => {

        if (callers.checked) {
            const mockCall = new bootstrap.Modal(document.getElementById('mock-call-modal'));
            mockCall.show();
            portfolio.removeAttribute('required');
        } else {
            portfolio.setAttribute('required', 'required');
        }
    })

    const deleteExperienceForm = document.querySelectorAll('.deleteExperienceForm');
    console.log(deleteExperienceForm);
    if (deleteExperienceForm) {
        deleteExperienceForm.forEach((form) => {
            form.addEventListener('submit', (e)=> {
                e.preventDefault();
                handleDeleteConfirmation(form);
            });
        });
    }

});


$(document).ready(function() {

    $('#websites').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Input all of your websites used here..',
    });

    $('#tools').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Input all of your tools used here..',
    });

    $('#skills').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Input all of your skills here..',
    });

    $('#softskills').select2({
        tags: true,
        tokenSeparators: [','],
        // tokenSeparators: [',', ' '],
        placeholder: 'Input all soft skills here..',
        // allowClear: true,
    });
});
