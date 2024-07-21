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

    const checkboxes = document.querySelectorAll('.formCheckInput');
    const callers = document.getElementById('position3');
    const portfolio = document.getElementById('portfolio');

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // console.log(callers.id);
            if (callers.checked) {
                portfolio.removeAttribute('required');
                const mockCall = new bootstrap.Modal(document.getElementById('mock-call-modal'));
                mockCall.show();
            } else {
                portfolio.setAttribute('required', 'required');
            }

            checkboxes.forEach(function(cb) {
                // console.log(cb.id);
                if (cb.id !== 'position3' && cb.checked) {
                    // console.log("Found.");
                    portfolio.setAttribute('required', 'required');
                }
            });
        });
    });

    const deleteExperienceForm = document.querySelectorAll('.deleteExperienceForm');
    // console.log(deleteExperienceForm);
    if (deleteExperienceForm) {
        deleteExperienceForm.forEach((form) => {
            form.addEventListener('submit', (e)=> {
                e.preventDefault();
                handleDeleteConfirmation(form);
            });
        });
    }

    const skype = document.getElementById('skype');

    skype.addEventListener('keyup', () => {
        mappedWords = ['NA',  'N/A', 'n/a', 'na', 'none', 'None', 'NONE'];

        for (var index = 0; index < mappedWords.length; index++) {
            if (skype.value === mappedWords[index]) {
                invalidSkype();
            }
        }

    });

    const experience = document.getElementById('experience');

    experience.addEventListener('keyup', () => {
        remindExpandExperience();
    });


});


$(document).ready(function() {

    $('#websites').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Input all of your websites used here..select below or type the "unlisted" ones.',
    });

    $('#tools').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Input all of your tools used here..select below or type the "unlisted" ones.',
    });

    $('#skills').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Input all of your skills here..select below or type the "unlisted" ones.',
    });

    $('#softskills').select2({
        tags: true,
        tokenSeparators: [','],
        // tokenSeparators: [',', ' '],
        placeholder: 'Input all soft skills here..select below or type the "unlisted" ones.',
        // allowClear: true,
    });
});
