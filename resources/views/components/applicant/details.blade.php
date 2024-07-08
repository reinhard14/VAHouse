<!-- Add details Modal -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div class="modal fade" id="create-details-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Experience Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>
            <div class="row text-center p-3">
                <div class="col fst-italic">
                    Kindly repeat the process until the desired result is fulfilled.
                </div>
            </div>
            <form id="experienceForm">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id(); }}">
                <div class="modal-body">
                    <label class="form-label" for="title">Job Experience</label>
                    <input class="form-control mb-2" type="text" id="title" name="title" required>

                    <label class="form-label" for="duration">Duration of experience</label>
                    <input class="form-control mb-2" type="text" id="duration" name="duration" required>
                    <small>ex. 1 year 6 months</small>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" id="saveButton">
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

            var formData = {
                title: $('#title').val(),
                duration: $('#duration').val(),
                user_id: $('#user_id').val(),
                _token: '{{ csrf_token() }}'
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

                    console.log(hasExperiences);
                    if (!hasExperiences) {
                        const newTable = `
                                <table class="table table-hover border">
                                    <thead>
                                        <tr>
                                            <th scope="col">Job Experience</th>
                                            <th scope="col">Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody id="experienceRow">
                                        <tr>
                                            <td>` + response.experience.title + '</td>' +
                                            '<td>' + response.experience.duration + `</td>
                                        </tr>
                                    </tbody>
                                </table>`;

                        $('#showExperiencesTable').append(newTable);
                    } else {
                        const newRow = `
                                <tr>
                                    <td>`
                                        + response.experience.title +
                                    '</td>' +
                                    '<td>'
                                        + response.experience.duration + `
                                    </td>
                                </tr>
                                `;
                        $('#experienceRow').append(newRow);
                    }

                    $('#create-details-modal').modal('hide');

                },
                error: function(response) {
                    alert('Please fill the fields with correct data.');
                }
            });
        });
    });
</script>
