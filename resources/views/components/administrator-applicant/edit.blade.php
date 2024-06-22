<!--Edit Modal -->

<div class="modal fade" id="edit-user-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editUserForm" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <label class="form-label" for="name">First Name </label>
                    <input class="form-control mb-2" type="text" name="name" value="{{ $user->name }}" required>

                    <label class="form-label" for="lastname">Last Name </label>
                    <input class="form-control mb-2" type="text" name="lastname" value="{{ $user->lastname }}" required>

                    <label class="form-label" for="email">Email Address </label>
                    <input class="form-control mb-2" type="email" name="email" value="{{ $user->email }}" required>

                    <label class="form-label" for="contactnumber">Contact Number</label>
                    <input class="form-control mb-2" type="number" value="{{ $user->contactnumber }}" name="contactnumber" required>

                    <label class="form-label" for="password">Password </label>
                    <div class="input-group mb-2">
                        <input class="form-control editPassword" type="password" name="password" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary editTogglePassword">
                                <i class="bi bi-eye-slash editToggleIcon"></i>
                            </button>
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

