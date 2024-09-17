<!-- Add references Modal -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div id="create-references-modal" class="modal fade long" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add References Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form>
                @csrf
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id(); }}">
                <input type="hidden" id="is_reference_completed" name="is_reference_completed" value="1">

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Incase of Emergency</label>
                            <input type="text" id="emergency_person" name="emergency_person" class="form-control mb-2" placeholder="Name of person">
                            <input type="text" id="emergency_relationship" name="emergency_relationship" class="form-control mb-2" placeholder="Relationship with the person">
                            <input type="text" id="emergency_number" name="emergency_number" class="form-control mb-2" placeholder="Contact number of person">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="start_date" class="form-label">Date of Commencement</label>
                            <input type="date" id="start_date" name="start_date" class="form-control mb-2">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="department" class="form-label">Department / Direct Client Name</label>
                            <input type="text" id="department" name="department" class="form-control mb-2" placeholder="Enter department/client name here">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="team_leader" class="form-label">Team Leader / Direct Client Name</label>
                            <input type="text" id="team_leader" name="team_leader" class="form-control mb-2" placeholder="Enter Team leader/client name here">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="referral" class="form-label">How did you learn about the job opening?</label>
                            <select id="referral" name="referral" class="form-control">
                                <option value="Facebook">Facebook</option>
                                <option value="Referral">Referral</option>
                                <option value="Onlinejobs.com">Onlinejobs.com</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label class="form-label" for="preferred_shift">Preferred shift</label>
                            <select id="preferred_shift" name="preferred_shift" class="form-control">
                                <option value="Night Shift">Night Shift</option>
                                <option value="Day Shift">Day Shift</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="work_status" class="form-label">Work Status</label>
                            <select id="work_status" name="work_status" class="form-control">
                                <option value="Part-time">Part-time</option>
                                <option value="Full-time">Full-time</option>
                                <option value="Hybrid">Hybrid (Both full-time & part-time for multiple client)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="services_offered" class="form-label">Services Offered</label>
                            <select id="services_offered" name="services_offered[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                <option value="General Virtual Assistant">General Virtual Assistant (Cold Calling, Email & Chat Support)</option>
                                <option value="Social Media Management">Social Media Management</option>
                                <option value="Accounting and bookkeeping">Accounting and bookkeeping</option>
                                <option value="Project Management">Project Management</option>
                                <option value="Team Management">Team Management</option>
                                <option value="E-commerce">E-commerce</option>
                                <option value="VA House Admin Staff">VA House Admin Staff</option>
                                <option value="Graphics & Designs">Graphics & Designs</option>
                                <option value="Web Management & Development">Web Management & Development</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" id="saveReferencesButton" class="btn btn-primary btn-sm">
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
        $('#services_offered').select2({
            placeholder: 'Please select services offered.',
        });
    });

    $('#saveReferencesButton').on('click', function(e){
        e.preventDefault();
        $(this).attr('disabled', true);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var formData = {
            emergency_person: $('#emergency_person').val(),
            emergency_relationship: $('#emergency_relationship').val(),
            emergency_number: $('#emergency_number').val(),
            emergency_person: $('#emergency_person').val(),
            start_date: $('#start_date').val(),
            department: $('#department').val(),
            team_leader: $('#team_leader').val(),
            referral: $('#referral').val(),
            preferred_shift: $('#preferred_shift').val(),
            work_status: $('#work_status').val(),
            services_offered: $('#services_offered').val(),
            is_reference_completed: $('#is_reference_completed').val(),
            user_id: $('#user_id').val(),
            _token: csrfToken,
        };

        $.ajax({
            type: 'POST',
            url: '{{ route("user.references.store") }}' ,
            data: formData,

            success: function(response) {
                handleReferencesFormSubmission();
                $('#create-references-modal').modal('hide');
            },

            error: function(jqXHR) {
                try {
                    var responseJson = JSON.parse(jqXHR.responseText);
                    var errorResponse = responseJson.errors
                        ? Object.values(responseJson.errors).flat()
                        : 'No errors found in the response';

                    formattedResponse = JSON.stringify(errorResponse);
                    console.log(formattedResponse);
                    handleReferencesWithMissingField(formattedResponse);
                } catch (e) {
                    alert('Invalid JSON response: ' + jqXHR.responseText);
                }
            },
        });

        setTimeout(() => {
                        $(this).removeAttr('disabled');
                    }, 10000);
    });
</script>
