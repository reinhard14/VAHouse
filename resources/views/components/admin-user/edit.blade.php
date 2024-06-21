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
                        <input class="form-control" type="password" name="password" id="password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const toggleIcon = document.querySelector('#toggleIcon');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute using getAttribute() and setAttribute()
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the icon
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    });
</script>
