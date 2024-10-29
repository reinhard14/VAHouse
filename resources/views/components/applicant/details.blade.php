<!-- Add details Modal -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div id="create-details-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Experience Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>
            <div class="row text-center p-3">
                <div class="col fst-italic">
                    Kindly add all of your previous experiences.
                </div>
            </div>
            <form id="experienceForm">
                @csrf
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id(); }}">
                <input type="hidden" id="is_experience_completed" name="is_experience_completed" value="1">

                <div class="modal-body">
                    <label for="title" class="form-label">Job Experience</label>
                    <input type="text" id="title" name="title" class="form-control mb-2">

                    <label for="duration" class="form-label">Duration of experience</label>
                    <input type="text" id="duration" name="duration" class="form-control mb-2" >
                    <small>ex. 1 year 6 months</small>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="saveButton" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-square mr-1"></i> Add
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-file-x"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#saveButton').on('click', function(e){
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var formData = {
                title: $('#title').val(),
                duration: $('#duration').val(),
                user_id: $('#user_id').val(),
                is_experience_completed: $('#is_experience_completed').val(),
                _token: csrfToken,
            };

            $.ajax({
                type: 'POST',
                url: '{{ route("user.experience") }}',
                data: formData,

                success: function(response) {

                    handleExperienceFormSubmission();
                    $('#experienceForm')[0].reset();
                    $('#noExperiencePlaceholder').remove();

                    const hasExperiences = response.exists;
                    const title = response.experience.title;
                    const duration = response.experience.duration;

                    if (!hasExperiences) {
                        const newTable = `
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Job Experience</th>
                                        <th scope="col">Duration</th>
                                    </tr>
                                </thead>
                                <tbody id="experienceRow">
                                    <tr>
                                        <td> ${title} </td>
                                        <td> ${duration} </td>
                                    </tr>
                                </tbody>
                            </table>
                            `;

                        $('#showExperiencesTable').append(newTable);
                    } else {
                        const newRow = `
                            <tr>
                                <td>
                                    ${title}
                                </td>
                                <td>
                                    ${duration}
                                </td>
                            </tr>
                            `;
                        $('#experienceRow').append(newRow);
                    }

                    $('#create-details-modal').modal('hide');
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
</script>
