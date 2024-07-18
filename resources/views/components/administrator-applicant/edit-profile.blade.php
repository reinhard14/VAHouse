<!--Edit UModal -->

<div class="modal fade" id="edit-user-profile-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editUserForm" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row text-center mb-3">
                        <div class="col">
                            <div class="btn-group">
                                <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Personal</a>
                                <a href="#" type="button" class="btn btn-secondary btn-flat disabled" data-bs-toggle="modal">Profile</a>
                                <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Skillset</a>
                                <a href="#edit-user-files-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Files</a>
                            </div>
                        </div>
                    </div>

                    <label class="form-label" for="email">Rate </label>
                    <input class="form-control mb-2" type="text" name="email" value="{{ $user->information->rate }}" required>

                    <label class="form-label" for="name">Experience </label>
                    <input class="form-control mb-2" type="number" name="name" value="{{ $user->information->experience }}" required>

                    <label class="form-label" for="lastname">Skype </label>
                    <input class="form-control mb-2" type="text" name="lastname" value="{{ $user->information->skype }}" required>

                    <label class="form-label" for="age">Niche </label>
                    <input class="form-control mb-2" type="text" name="age" value="{{ $user->information->niche }}" required>

                    <label class="form-label" for="age">Union Bank Name </label>
                    <input class="form-control mb-2" type="text" name="age" value="{{ $user->information->ub_account }}" required>

                    <label class="form-label" for="age">Union Bank Account </label>
                    <input class="form-control mb-2" type="text" name="age" value="{{ $user->information->ub_number }}" required>

                    <label class="form-label" for="age">Positions</label>
                    <input class="form-control mb-2" type="text" name="age" value="{{ $user->age }}" required>

                </div>
                <small class="text-left ml-3">
                    last updated: {{ $user->updated_at->diffForHumans() }}
                </small>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> Update
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-arrow-return-right mr-1"></i>Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

