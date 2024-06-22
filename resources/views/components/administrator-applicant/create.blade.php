<!-- Add Applicants Modal -->

<div class="modal fade" id="create-user-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Applicant</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form id="addApplicantsForm" method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <input type="hidden" name="role_id" value="3">
                <div class="modal-body">
                    <label class="form-label" for="name">Name </label>
                    <input class="form-control mb-2" type="text" name="name" required>

                    <label class="form-label" for="lastname">Last Name </label>
                    <input class="form-control mb-2" type="text" name="lastname" required>

                    <label class="form-label" for="email">Email Address </label>
                    <input class="form-control mb-2" type="email" name="email" required>

                    <label class="form-label" for="contactnumber">Contact Number</label>
                    <input class="form-control mb-2" type="number" name="contactnumber" required>

                    <label class="form-label" for="password">Password </label>
                    <div class="input-group mb-2">
                        <input class="form-control" type="password" name="password" id="password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-square mr-1"></i> Add
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-file-x"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
