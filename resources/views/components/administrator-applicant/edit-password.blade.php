<!--Edit Password Modal -->

<div class="modal fade" id="edit-user-password-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Applicant's Password</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            {{-- <form class="editUserForm" method="POST" action="{{ route('update.user.password', $user->id) }}"> --}}
            <form id="edit-password-form-{{ $user->id }}" data-user-id="{{ $user->id }}">

                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row text-center mb-5">
                        <div class="col">
                            <div class="btn-group">
                                <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Info</a>
                                <a href="#edit-user-profile-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Profile</a>
                                <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Skillset</a>
                                <a href="#edit-user-experience-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Experiences</a>
                                <a href="#edit-user-references-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">References</a>
                                <a href="#edit-user-files-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Files</a>
                                <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm disabled" data-bs-toggle="modal">Password</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="password">New Password </label>
                            <div class="input-group mb-2">
                                <input type="password" name="password" class="form-control editPassword" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary editTogglePassword">
                                        <i class="bi bi-eye-slash editToggleIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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

