$(document).ready(function() {
    $(document).on('submit', 'form[id^="edit-references-form-"]', function(e) {
        e.preventDefault();

        var userId = $(this).data('user-id');
        var form = $('#edit-references-form-' + userId);
        var formData = form.serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var url = '/administrator/users/' + userId + '/references';


        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                handleReferencesForm(response);
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
