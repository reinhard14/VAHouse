<!-- Add Modal -->
<div class="modal fade" id="create-department-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Department</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form id="addDepartmentForm" method="POST" action="{{ route('department.store') }}">
                @csrf
                <div class="modal-body">
                    <label class="form-label" for="code">Code </label>
                    <input class="form-control mb-2" type="text" name="code" required>

                    <label class="form-label" for="name">Title </label>
                    <input class="form-control mb-2" type="text" name="name" required>

                    <label class="form-label" for="description">Description </label>
                    <input class="form-control mb-2" type="text" name="description" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-file-earmark-check"></i> Add
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
