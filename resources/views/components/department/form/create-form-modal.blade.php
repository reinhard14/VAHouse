<!-- Add Modal -->
<div class="modal fade" id="create-form-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create a form for {{ $dept->name }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form id="addFormModal" method="POST" action="{{ route('form.store') }}">
                @csrf
                <input type="hidden" name="department_id" value="{{ $dept->id }}">

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <label class="form-name" for="form-name">Form Name</label>
                        </div>
                        <div class="col">
                            <input class="form-control mb-2" type="text" name="form-name" placeholder="Form Name..." required>
                        </div>
                    </div>
                </div>
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
