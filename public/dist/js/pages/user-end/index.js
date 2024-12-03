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
        mappedWords = ['NA',  'N/A', 'n/a', 'na', 'none', 'None', 'NONE', 'not applicable', 'Not applicable', 'NOT APPLICABLE'];

        for (var index = 0; index < mappedWords.length; index++) {
            if (skype.value === mappedWords[index]) {
                invalidSkype();
            }
        }

    });

    const experience = document.getElementById('experience');

    experience.addEventListener('blur', () => {
        remindExpandExperience();
    });

    const references = document.getElementById('videolink');

    references.addEventListener('input', () => {
        reminderExpandReference();
    });

    //128MB
    const videoInput = document.getElementById('videolink');

    videoInput.addEventListener('input', () => {
        const file = videoInput.files[0]; // Get the first file

        checkFileSize(file, videoInput);
    });

    //64MB
    const photoIdInput = document.getElementById('photo_id');

    photoIdInput.addEventListener('input', () => {
        const file = photoIdInput.files[0];

        checkFileSize(file, photoIdInput);
    });

    //64MB
    const photoFormalInput = document.getElementById('photo_formal');

    photoFormalInput.addEventListener('input', () => {
        const file = photoFormalInput.files[0];

        checkFileSize(file, photoFormalInput);
    });
    //64MB
    const portfolioInput = document.getElementById('portfolio');

    portfolioInput.addEventListener('input', () => {
        const file = portfolioInput.files[0];

        checkFileSize(file, portfolioInput);
    });

    //32MB
    const resumeInput = document.getElementById('resume');

    resumeInput.addEventListener('input', () => {
        const file = resumeInput.files[0];

        checkFileSize(file, resumeInput);
    });

    //32MB
    const discResultsInput = document.getElementById('disc_results');

    discResultsInput.addEventListener('input', () => {
        const file = discResultsInput.files[0];

        checkFileSize(file, discResultsInput);
    });

    //Check files and remove on field.
    function checkFileSize(file, fileInput) {
        // console.log(fileInput.name);
        if (file) {
            const fileSizeMB = file.size / (1024 * 1024);
            const fileSizeLimits = {
                resume: 32,
                disc_results: 32,
                videolink: 128,
            };

            const maxFileSizeMB = fileSizeLimits[fileInput.name] || 64;

            if (fileSizeMB > maxFileSizeMB) {
                reminderExceedingFileSize(fileSizeMB);
                fileInput.value = '';
            }
        }
    }

});


$(document).ready(function() {

    $('#websites').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: '',
    });

    $('#tools').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: '',
    });

    $('#skills').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: '',
    });

    $('#softskills').select2({
        tags: true,
        tokenSeparators: [','],
        // tokenSeparators: [',', ' '],
        placeholder: 'Manually add softskills.',
        // allowClear: true,
    });

    $('.modal.long').on('shown.bs.modal', function () {
        $(this).find('.modal-body').css({
            'max-height': '400px',
            'overflow-y': 'auto'
        });
    });
});
