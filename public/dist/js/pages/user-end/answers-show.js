document.addEventListener("DOMContentLoaded", function() {
    const deleteFormAnswers = document.querySelectorAll('.deleteFormAnswers');

    deleteFormAnswers.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            handleDeleteConfirmation(form);
        });
    })

});
