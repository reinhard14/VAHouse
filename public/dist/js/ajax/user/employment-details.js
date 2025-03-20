$(document).ready(function(){

    $('#saveButton').on('click', function(e){
        e.preventDefault();

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var formData = {
            employment_type: $('input[name="employment_type"]:checked').val(),
            date_started: $('#date_started').val(),
            date_ended: $('#date_ended').val(),
            job_position: $('#job_position').val(),
            company_details: $('#company_details').val(),
            job_details: $('#job_details').val(),
            user_id: $('#user_id').val(),
            _token: csrfToken,
        };

        $.ajax({
            type: 'POST',
            url: employmentRoute,
            data: formData,

            success: function(response) {

                handleExperienceFormSubmission();
                $('#experienceForm')[0].reset();

                $('#create-details-modal').modal('hide');
            },

            error: function(jqXHR) {

                try {
                    var responseJson = JSON.parse(jqXHR.responseText);
                    var errorResponse = responseJson.errors
                        ? Object.values(responseJson.errors).flat()
                        : 'No errors found in the response';

                    formattedResponse = JSON.stringify(errorResponse);

                    handleMissingFields(formattedResponse);
                } catch (e) {
                    alert('Invalid JSON response: ' + jqXHR.responseText);
                }
            }
        });
    });
});
