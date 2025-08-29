<!-- Add details Modal -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div id="create-details-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employment Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form id="experienceForm">
                @csrf
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id(); }}">

                <div class="modal-body">
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
                        <input type="date" id="date_started" class="form-control">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-arrow-right-short"></i></span>
                        </div>
                        <input type="date" id="date_ended" class="form-control">
                    </div>

                    <label for="job_position" class="form-label custom-label">Job Position</label>
                    <input type="text" id="job_position" name="job_position" class="form-control mb-2">

                    <label for="company_details" class="form-label custom-label">Company Name, Company Address</label>
                    <input type="text" id="company_details" name="company_details" class="form-control mb-2" >

                    <label for="job_details" class="form-label custom-label">Job Details</label>
                    <textarea id="job_details" class="form-control mb-2"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="saveButton" class="btn btn-vah-orange">
                        <i class="bi bi-plus-square mr-1"></i> Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-file-x"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var employmentRoute = "{{ route('user.experience') }}";
</script>
