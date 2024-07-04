<!-- Add details Modal -->

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
            <form id="addExperienceForm" method="POST" action="{{ route('user.experience') }}">
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
        $('#addExperienceForm').on('submit', function(e){
            e.preventDefault(); // Prevent form submission

            var formData = {
                title: $('#title').val(),
                duration: $('#duration').val(),
                user_id: $('#user_id').val(),
                _token: '{{ csrf_token() }}' // Laravel CSRF token
            };

            $.ajax({
                type: 'POST',
                url: '{{ route("user.experience") }}', // Your route name
                data: formData,
                success: function(response) {
                    // Handle success
                    alert('Data saved successfully!');
                    $('#create-details-modal').modal('hide'); // Hide modal
                },
                error: function(response) {
                    // Handle error
                    alert('An error occurred.');
                }
            });
        });
    });
</script>
