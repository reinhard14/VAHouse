<!-- Add references Modal -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div class="modal fade long" id="create-references-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add References Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form method="POST" action="{{ route('user.references.store') }}">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id(); }}">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Incase of Emergency</label>
                            <input class="form-control mb-2" type="text" name="emergency_person" placeholder="Name of person" required>
                            <input class="form-control mb-2" type="text" name="emergency_relationship" placeholder="Relationship with the person" required>
                            <input class="form-control mb-2" type="text" name="emergency_number" placeholder="Contact number of person" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="start_date">Date of Commencement</label>
                            <input class="form-control mb-2" type="date" name="start_date" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="start_date">Department / Direct Client Name</label>
                            <input class="form-control mb-2" type="text" name="department" placeholder="Enter department/client name here" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="start_date">Team Leader / Direct Client Name</label>
                            <input class="form-control mb-2" type="text" name="team_leader" placeholder="Enter Team leader/client name here" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label class="form-label" for="referral">How did you learn about the job opening?</label>
                            <select class="form-control" name="referral">
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
                            <select class="form-control" name="preferred_shift">
                                <option value="Night Shift">Night Shift</option>
                                <option value="Day Shift">Day Shift</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label class="form-label" for="work_status">Work Status</label>
                            <select class="form-control" name="work_status">
                                <option value="Part-time">Part-time</option>
                                <option value="Full-time">Full-time</option>
                                <option value="Hybrid">Hybrid (Both full-time & part-time for multiple client)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label class="form-label" for="services_offered">Services Offered</label>
                            <select id="services_offered" name="services_offered[]" class="form-control select2"  multiple="multiple" style="width: 100%;">
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
                    <button type="submit" class="btn btn-primary btn-sm">
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
</script>
