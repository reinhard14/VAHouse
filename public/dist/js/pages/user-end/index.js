document.addEventListener("DOMContentLoaded", function() {
    //Submitting scores field.
    const form = document.getElementById('scoresForm')
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            handleScoreFormSubmission(form);
        });
    }

    //Resetting applicant's fields.
    const resetFieldButton = document.getElementById('resetFieldButton');

    if (resetFieldButton) {
        resetFieldButton.addEventListener('click', (e) => {
            e.preventDefault();
            handleClearSelects();
        });
    }

    //Show modal upon login.
    const guidelinesModal = new bootstrap.Modal(document.getElementById('guidelinesModal'));
    guidelinesModal.show();
});


$(document).ready(function() {
    // $('#guidelinesModal').modal('show');

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
