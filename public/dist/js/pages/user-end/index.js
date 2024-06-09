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


// In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#websites').select2({
            maximumSelectionLength: 10,
            placeholder: 'Select websites..',
        });

        $('#applications').select2({
            maximumSelectionLength: 10,
            placeholder: 'Select applications..',
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
    });
