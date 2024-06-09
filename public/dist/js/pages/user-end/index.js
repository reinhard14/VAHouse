document.addEventListener("DOMContentLoaded", function() {
    //submitting scores field.
    const form = document.getElementById('scoresForm')
    //resetting admin fields.
    const resetFieldButton = document.getElementById('resetFieldButton');

    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            handleScoreFormSubmission(form);
        });
    }

    if (resetFieldButton) {
        resetFieldButton.addEventListener('click', (e) => {
            e.preventDefault();
            handleClearSelects();
        });
    }
});


$(document).ready(function() {

    $('#websites').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Input all of your websites used here..',
    });

    $('#applications').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Input all of your applications used here..',
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
