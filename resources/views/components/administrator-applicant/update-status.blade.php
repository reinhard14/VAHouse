<!-- Add Notes Modal -->

<div class="modal fade" id="update-status-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set status for this applicant</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editApplicantStatus" method="POST" action="{{ route('update.applicant.status', $user->id) }}">
                @csrf
                @method('put')
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

                <div class="modal-body">
                    <label class="form-label" for="status">Status: </label>

                    <select name="status" class="form-control" required>
                        <option value="New" {{ old('status', $user->status->status ?? '') == 'New' ? 'selected disabled' : '' }}>New</option>
                        <option value="Onboarded" {{ old('status', $user->status->status ?? '') == 'Onboarded' ? 'selected disabled' : '' }}>Onboarded</option>
                        <option value="Hired" {{ old('status', $user->status->status ?? '') == 'Hired' ? 'selected disabled' : '' }}>Hired</option>
                        <option value="Floating" {{ old('status', $user->status->status ?? '') == 'Floating' ? 'selected disabled' : '' }}>Floating</option>
                        <option value="Terminated" {{ old('status', $user->status->status ?? '') == 'Terminated' ? 'selected disabled' : '' }}>Terminated</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> Update
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-file-x  mr-1"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
