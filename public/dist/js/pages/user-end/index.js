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
