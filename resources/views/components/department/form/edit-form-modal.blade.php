<!-- Edit Form Modal -->
<div class="modal fade" id="edit-form-modal{{ $form->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Form {{ $form->name }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editFormModal" method="POST" action="{{ route('form.update', $form->id) }}">
                @csrf
                @method('PUT')
                {{-- <input type="hidden" name="department_id" value="{{ $form->department->id }}"> --}}

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <label class="form-name" for="form-name">Form Name</label>
                        </div>
                        <div class="col">
                            <input class="form-control mb-2" type="text" name="form-name" value="{{ $form->name }}" required>
                        </div>
                    </div>
                </div>
            </div>
            <small class="text-left ml-3">
                created: {{ $form->created_at->diffForHumans() }}
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
