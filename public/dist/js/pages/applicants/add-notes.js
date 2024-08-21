$(document).ready(function() {
    $(document).on('submit', 'form[id^="add-notes-form-"]', function(e) {
        e.preventDefault();

        var userId = $(this).data('user-id');
        var form = $('#add-notes-form-' + userId);
        var formData = form.serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: addNotesRoute,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                handleAddNotesForm(response);

                const notesShowCard = `
                                    <div class="row mt-3 px-3">
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-header">
                                                    Note: Just now
                                                </div>
                                                <div class="card-body">
                                                    ${response.review.notes}
                                                </div>
                                                <div class="card-footer">
                                                    <strong>Updated by: </strong> ${response.review.reviewed_by}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;

                $('#notesShowCard-' + userId).prepend(notesShowCard);
                $('#rowNotesUnavailable-' + userId).hide();

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
