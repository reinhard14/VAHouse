$(document).ready(function() {
    $(document).on('submit', 'form[id^="delete-experience-form-"]', function(e) {
        e.preventDefault();

        var experienceId = $(this).data('experience-id');
        var form = $('#delete-experience-form-' + experienceId);
        var formData = form.serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var url = '/administrator/users/experiences/' + experienceId + '/delete';

        var confirmation = confirm('Are you sure you want to delete this VA\'s experience?');

        if (confirmation) {
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
        }
    });

    // $('#addExperienceButton').on('click', function(){
    $(document).on('click', '[id^="addExperienceButton-"]', function() {
        var userId = $(this).data('user-id');
        // console.log('Clicked button with user ID:', userId);
        // Add a new element to the open modal
        $(`#modalContent-${userId}`).append(`
            <div class="form-group">
                <label for="title">Job Experience</label>
                <input type="text" id="title" name="title" class="form-control mb-3" placeholder="Enter new experience">

                <label for="duration">Duration</label>
                <input type="text" id="duration" name="duration" class="form-control" placeholder="Enter duration of experience">

                <div class="text-right mt-3">
                    <button type="submit" id="addNewExperience" class="btn btn-outline-info btn-sm">Add Entry</button>
                    <button type="button" id="removeExperience-${userId}" class="btn btn-outline-danger btn-sm" data-user-id="${userId}">Hide</button>
                </div>
            </div>
        `);

        // Optional: Scroll to the new element or highlight it
        $('#title').focus().css('background-color', '#f0f8ff');
        $('#duration').focus().css('background-color', '#f0f8ff');

        // console.log($('#modalContent-'+userId));

        if ($('#modalContent-' + userId).length >= 1) {
            $('#addExperienceButton-' + userId).prop('disabled', true);
        }
    });

    // Event listener to handle the removal of the latest experience group
    $(document).on('click', '[id^="removeExperience-"]', function(){
        var userId = $(this).data('user-id');

        // Remove the form group containing this button
        $(this).closest('.form-group').remove();
        // console.log(userId);
        $('#addExperienceButton-' + userId).prop('disabled', false);
    });


    $(document).on('submit', 'form[id^="add-experience-form-"]', function(e) {
        e.preventDefault();

        var userId = $(this).data('user-id');
        var form = $('#add-experience-form-' + userId);
        var formData = form.serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var url = '/administrator/users/experiences/' + userId;

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },

            success: function(response) {

                $(`#tr_null_${userId}`).remove();
                handleAddExperienceForm(response);

                const experience_id = response.experience.id;
                const experience_title = response.experience.title;
                const experience_duration = response.experience.duration;

                const newRow = `
                        <tr id="tr_${experience_id}">
                            <td>
                                ${experience_title}
                            </td>
                            <td>
                                ${experience_duration}
                            </td>
                            <td>
                                Just Now
                            </td>
                            <td class="text-right">
                                <form id="delete-experience-form-${experience_id}" data-experience-id="${experience_id}">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash mr-1"></i></button>
                                </form>
                            </td>
                        </tr>
                        `;
                $(`#experienceRow-${userId}`).append(newRow);

            },
            error: function(jqXHR) {
                try {
                    var responseJson = JSON.parse(jqXHR.responseText);
                    var errorResponse = responseJson.errors
                        ? Object.values(responseJson.errors).flat()
                        : 'No errors found in the response';

                    formattedResponse = JSON.stringify(errorResponse);
                    // console.log(formattedResponse);
                    handleReferencesWithMissingField(formattedResponse);
                } catch (e) {
                    alert('Invalid JSON response: ' + jqXHR.responseText);
                }
            }
        });
    });
});
