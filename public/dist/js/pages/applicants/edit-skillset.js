$(document).ready(function() {
    $(document).on('submit', 'form[id^="edit-skillset-form-"]', function(e) {
        e.preventDefault();

        var userId = $(this).data('user-id');
        var form = $('#edit-skillset-form-' + userId);
        var formData = form.serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var url = '/administrator/users/' + userId + '/skillset';

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                handleSkillsetForm(response);
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
