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
        placeholder: 'Select from list or type all of the websites used, if not in the list manually type in the field and separate by "enter" or "tab".',
    });

    $('#tools').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Select from list or type all of the tools used, if not in the list manually type in the field and separate by "enter" or "tab".',
    });

    $('#skills').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Select from list or type all of your hard/technical skills, if not in the list manually type in the field and separate by "enter" or "tab".',
    });

    $('#softskills').select2({
        tags: true,
        tokenSeparators: [','],
        // tokenSeparators: [',', ' '],
        placeholder: 'Select from list or type all of your soft skills, if not in the list manually type in the field and separate by "enter" or "tab".',
        // allowClear: true,
    });

    $('.modal.long').on('shown.bs.modal', function () {
        $(this).find('.modal-body').css({
            'max-height': '400px',
            'overflow-y': 'auto'
        });
    });
});
