document.addEventListener("DOMContentLoaded", function() {

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
