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
                    <label class="form-label" for="age">Age </label>
                    <input class="form-control mb-2" type="number" name="age" required>

                    <label class="form-label" for="gender">Gender </label>
                    <select name="gender" class="form-control mb-2">
                        <option value="Male" {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected disabled' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected disabled' : '' }}>Female</option>
                        <option value="Transgender" {{ old('gender', $user->gender ?? '') == 'Transgender' ? 'selected disabled' : '' }}>Transgender</option>
                        <option value="Non binary" {{ old('gender', $user->gender ?? '') == 'Non-Binary/Non-Conforming' ? 'selected disabled' : '' }}>Non-Binary/Non-Conforming</option>
                        <option value="Prefer not to respond" {{ old('gender', $user->gender ?? '') == 'Prefer not to respond' ? 'selected disabled' : '' }}>Prefer not to respond</option>
                    </select>

                    <label class="form-label" for="education">Highest Educational Attainment </label>
                    <select name="education" class="form-control mb-2">
                        <option value="High School">High School</option>
                        <option value="Senior High School">Senior High School</option>
                        <option value="College Undergrad">College Undergrad</option>
                        <option value="College Degree">College Degree</option>
                        <option value="Masters Degree">Master's Degree</option>
                        <option value="Professional Degree">Professional Degree</option>
                        <option value="Doctorate Degree">Doctorate Degree</option>
                        <option value="Vocational">Vocational</option>
                    </select>

                    <label class="form-label" for="email">Email Address </label>
                    <input class="form-control mb-2" type="email" name="email" value="{{ $user->email }}" required>

                    <label class="form-label" for="address">Address</label>
                    <input class="form-control mb-2" type="text" name="address" required>

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

