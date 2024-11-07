document.addEventListener("DOMContentLoaded", function() {

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

});


$(document).ready(function() {
    $('.modal.long').on('shown.bs.modal', function () {
        $(this).find('.modal-body').css({
            'max-height': '400px',
            'overflow-y': 'auto'
        });
    });

    $('a[data-toggle="tab"]').on('click', function(e) {
        e.preventDefault(); // Prevent the default anchor click behavior
        $(this).tab('show'); // Show the tab
    });

});
