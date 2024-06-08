<!--Edit Modal -->

<div class="modal fade" id="edit-department-modal{{ $dept->id }}" tabindex="-1">
{{-- <div class="modal fade" id="edit-department-modal{{ $dept->id }}" tabindex="-1" data-department-id="{{ $dept->id }}"> --}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Client User</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editDepartmentForm" method="POST" action="{{ route('department.update', $dept->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="department_id" id="edit-department-id" value="">

                <div class="modal-body">
                    <label class="form-label" for="code">First Name </label>
                    <input class="form-control mb-2" type="text" name="code" value="{{ $dept->code }}" required>

                    <label class="form-label" for="name">Last Name </label>
                    <input class="form-control mb-2" type="text" name="name" value="{{ $dept->name }}" required>

                    <label class="form-label" for="description">Description </label>
                    <input class="form-control mb-2" type="text" name="description" value="{{ $dept->description }}" required>
                </div>
                <small class="text-left ml-3">
                    created: {{ $dept->created_at->diffForHumans() }}
                </small>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> Update
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
