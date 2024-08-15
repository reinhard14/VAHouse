$(document).ready(function() {
    $(document).on('submit', 'form[id^="edit-files-form-"]', function(e) {
        e.preventDefault();

        var userId = $(this).data('user-id');
        var form = $('#edit-files-form-' + userId);
        var formData = new FormData(form[0]);
        var fileInput = '{{ $field }}'; // Replace with the actual field name
        var file = formData.get(fileInput);

        if (file && file.size > 0) {
            console.log('File is present:', file.name);
        } else {
            console.log('No file selected');
        }
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        console.log('Form submit button clicked for user ID:', userId, form);
        console.log('Form data for user ID ' + userId + ':', formData);

        $.ajax({
            type: 'POST',
            url: editFileRoute,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                handleEditFileForm(response);
            },
            error: function(jqXHR) {
                var formattedResponse;
                try {
                    var responseJson = JSON.parse(jqXHR.responseText);
                    var errorResponse = responseJson.errors
                        ? Object.values(responseJson.errors).flat()
                        : 'No errors found in the response';

                    formattedResponse = JSON.stringify(errorResponse);
                    handleFormWithMissingField(formattedResponse);
                } catch (e) {
                    alert('Invalid JSON response: ' + jqXHR.responseText);
                }
            }
        });
    });
});
