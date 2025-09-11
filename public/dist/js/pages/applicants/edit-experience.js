$(document).ready(function() {
    $(document).on('submit', 'form[id^="delete-experience-form-"]', function(e) {
        e.preventDefault();

        var experienceId = $(this).data('employment-id');
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

    $(document).on('click', '[id^="addExperienceButton-"]', function() {
        var userId = $(this).data('user-id');
        // console.log('Clicked button with user ID:', userId);
         $(`#modalContent-${userId}`).append(`
            <div class="form-group">
                <span>Employment Type</span>
                <div class="row mb-2">
                    <div class="col">
                        <input type="radio" id="VA" name="employment_type" value="VA">
                        <label for="VA" class="form-label custom-label">VA</label>
                    </div>
                    <div class="col">
                        <input type="radio" id="Corporate" name="employment_type" value="Corporate">
                        <label for="Corporate" class="form-label custom-label">Corporate</label>
                    </div>
                    <div class="col">
                        <input type="radio" id="BPO" name="employment_type" value="BPO">
                        <label for="BPO" class="form-label custom-label">BPO</label>
                    </div>
                </div>

                <label for="date" class="form-label custom-label">Date</label>
                <div class="input-group mb-3">
                    <input type="date" id="date_started" name="date_started" class="form-control">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-arrow-right-short"></i></span>
                    </div>
                    <input type="date" id="date_ended" name="date_ended" class="form-control">
                </div>

                <label for="job_position" class="form-label custom-label">Job Position</label>
                <input type="text" id="job_position" name="job_position" class="form-control mb-2">

                <label for="company_details" class="form-label custom-label">Company Name, Company Address</label>
                <input type="text" id="company_details" name="company_details" class="form-control mb-2" >

                <label for="job_details" class="form-label custom-label">Job Details</label>
                <textarea id="job_details" name="job_details" class="form-control mb-2"></textarea>

                <div class="text-right mt-3">
                    <button type="submit" id="addNewExperience" class="btn btn-outline-info btn-sm">Add Entry</button>
                    <button type="button" id="removeExperience-${userId}" class="btn btn-outline-secondary btn-sm" data-user-id="${userId}">Hide</button>
                </div>
            </div>
        `);

        // Optional: Scroll to the new element or highlight it
        $('#date_ended').css('background-color', '#f0f8ff');
        $('#date_started').css('background-color', '#f0f8ff');
        $('#job_position').focus().css('background-color', '#f0f8ff');
        $('#company_details').css('background-color', '#f0f8ff');
        $('#job_details').css('background-color', '#f0f8ff');

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
        $('#addExperienceButton-' + userId).prop('disabled', false);
    });


    $(document).on('submit', 'form[id^="add-experience-form-"]', function(e) {
        e.preventDefault();

        var userId = $(this).data('user-id');
        var form = $('#add-experience-form-' + userId);
        var formData = form.serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var url = '/administrator/users/experiences/' + userId;
        // console.log(formData + "Form Data");
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

                const employment_id = response.employment.id;
                const employment_type = response.employment.employment_type;
                const date_started = response.employment.date_started;
                const date_ended = response.employment.date_ended;
                const job_position = response.employment.job_position;
                const company_details = response.employment.company_details;
                const job_details = response.employment.job_details;

                const newRow = `
                        <tr id="tr_${employment_id}">
                            <td>
                                ${employment_type}
                            </td>
                            <td>
                                ${date_started}
                            </td>
                            <td>
                                ${date_ended}
                            </td>
                            <td>
                                ${job_position}
                            </td>
                            <td>
                                ${company_details}
                            </td>
                            <td>
                                ${job_details}
                            </td>
                            <td>
                                Just Now
                            </td>
                            <td class="text-right">
                                <form id="delete-experience-form-${employment_id}" data-employment-id="${employment_id}">
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
                    handleReferencesWithMissingField(formattedResponse);
                } catch (e) {
                    alert('Invalid JSON response: ' + jqXHR.responseText);
                }
            }
        });
    });
});
