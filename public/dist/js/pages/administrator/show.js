document.addEventListener("DOMContentLoaded", function() {
    const generateApplicantsForm = document.getElementById('generateApplicantsForm');

    generateApplicantsForm.addEventListener('click', (e) => {
        e.preventDefault();
        generateApplicantsFormConfirmation();
    });

});
