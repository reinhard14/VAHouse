$(document).ready(function() {
    $(document).on('submit', 'form[id^="delete-experience-form-"]', function(e) {
        e.preventDefault();
        console.log('Form submitted');

        var experienceId = $(this).data('experience-id');
        var form = $('#delete-experience-form-' + experienceId);
        var formData = form.serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var url = '/administrator/users/experiences/' + experienceId + '/delete';
        console.log(experienceId);
        $.ajax({
            type: 'DELETE',
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },

            success: function(response) {
                $('#tr_' + experienceId).remove();
                deleteExperienceForm(response);
            },
            error: function(jqXHR) {
                try {
                    var responseJson = JSON.parse(jqXHR.responseText);
                    var errorResponse = responseJson.errors
                        ? Object.values(responseJson.errors).flat()
                        : 'No errors found in the response';

                    var formattedResponse = JSON.stringify(errorResponse);
                    handleFormWithMissingField(formattedResponse);
                } catch (e) {
                    alert('Invalid JSON response: ' + jqXHR.responseText);
                }
            }
        });
    });
});
