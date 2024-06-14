<!-- Add Notes Modal -->

<div class="modal fade" id="add-notes-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add notes for this applicant</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form id="addUserForm" method="POST" action="{{ route('add.notes') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="reviewed_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="review_status" value="updated">
                <div class="modal-body">
                    <label class="form-label" for="notes">Note: </label>
                    <input class="form-control mb-2" type="text" name="notes" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-pen mr-1"></i> Add
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-file-x  mr-1"></i>Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
