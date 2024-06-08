<!-- Add Input on Form Modal -->
<div class="modal fade" id="create-input-modal{{ $form->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create an input for {{ $form->name }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form id="addInputModal" method="POST" action="{{ route('input.store') }}">
            @csrf
            <input type="hidden" name="department_id" value="{{ $form->department_id }}">
            <input type="hidden" name="form_id" value="{{ $form->id }}">

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-3">
                            <label class="form-label" for="input-type">Input Type</label>
                        </div>
                        <div class="col">
                            <select class="form-control" name="input-type" id="formType">
                                <option value="text">Text</option>
                                <option value="email">Email</option>
                                <option value="radio">Radio</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="select">Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">
                            <label class="form-label" for="input-label">Input Label</label>
                        </div>
                        <div class="col">
                            <input class="form-control mb-2" type="text" name="input-label" placeholder="Input Label" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">
                            <label class="form-label" for="input-required">Required ?</label>
                        </div>
                        <div class="col">
                            <select class="form-control" name="input-required">
                                <option value="required">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3" >
                            <label class="form-label" for="option">Option:</label>
                        </div>
                        <div class="col">
                            <div id="inputContainer">
                                <input class="form-control mb-2" type="text" name="option" id="option" placeholder="Option..." disabled>
                            </div>

                            <div>
                                <button type="button" id="addOption" class="btn btn-outline-primary mb-2" disabled><i class="bi bi-clipboard-plus"></i></button>
                                <button type="button" id="removeOption" class="btn btn-outline-danger mb-2" disabled><i class="bi bi-clipboard-minus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <ion-icon name="navigate-outline" class="mr-1"></ion-icon> Add
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>

            </form>

        </div>
    </div>
</div>
