$(document).ready(function() {
    $('.file-upload').on('change', function() {
        var input = $(this);
        var formData = new FormData();
        var file = input[0].files[0];
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var uploadUrl = input.data('upload-url');
        var allowedTypes = input.data('allowed-types');
        var maxSizeMB = parseFloat(input.data('max-size'));

        if (!allowedTypes) {
            alert("Missing allowed file types.");
            return;
        }
        allowedTypes = allowedTypes.split(',');

        if (!file) {
            alert("Please select a file.");
            return;
        }

        var fileType = file.type;
        var fileSizeMB = file.size / 1024 / 1024;

        if (!allowedTypes.includes(fileType)) {
            alert("Invalid file type. Allowed: " + allowedTypes.join(", "));
            input.val('');
            return;
        }

        if (fileSizeMB > maxSizeMB) {
            alert("File is too large! Max size: " + maxSizeMB + "MB");
            input.val('');
            return;
        }

        formData.append(input.attr('name'), file);

        // Show progress bar & spinner
        $('#upload-progress').show();
        $('#loading-spinner').show();

        $.ajax({
            url: uploadUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },

            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.onprogress = function(event) {
                    if (event.lengthComputable) {
                        var percentComplete = Math.round((event.loaded / event.total) * 100);
                        $('#progress-bar').css('width', percentComplete + '%').text(percentComplete + '%');
                    }
                };
                return xhr;
            },

            success: function(response) {

                handleFileFormSubmission(response);
                $('#upload-progress').hide();
                $('#loading-spinner').hide();
            },
            error: function(jqXHR) {
                try {
                    var responseJson = JSON.parse(jqXHR.responseText);
                    var errorResponse = responseJson.errors
                        ? Object.values(responseJson.errors).flat()
                        : 'No errors found in the response';

                    var formattedResponse = JSON.stringify(errorResponse);
                    handleFileFormWithMissingField(formattedResponse);
                } catch (e) {
                    alert('Invalid JSON response: ' + jqXHR.responseText);
                }

                $('#upload-progress').hide();
                $('#loading-spinner').hide();
            }
        });
    });
});

