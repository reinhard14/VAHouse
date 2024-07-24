<!--Edit Modal -->

<div class="modal fade long" id="edit-user-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Information</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editUserForm" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row text-center mb-5">
                        <div class="col">
                            <div class="btn-group">
                                <a href="#" type="button" class="btn btn-secondary btn-flat disabled">Personal</a>
                                <a href="#edit-user-profile-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Profile</a>
                                <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Skillset</a>
                                {{-- <a href="#edit-user-files-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Files</a> --}}
                                <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Password</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="name">First Name </label>
                            <input class="form-control mb-2" type="text" name="name" value="{{ $user->name }}" required>

                            <label class="form-label" for="lastname">Last Name </label>
                            <input class="form-control mb-2" type="text" name="lastname" value="{{ $user->lastname }}" required>
                            <label class="form-label" for="age">Age </label>
                            <input class="form-control mb-2" type="number" name="age" value="{{ $user->age }}" required>

                            <label class="form-label" for="gender">Gender </label>
                            <select name="gender" class="form-control mb-2">
                                <option value="Male" {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Transgender" {{ old('gender', $user->gender ?? '') == 'Transgender' ? 'selected' : '' }}>Transgender</option>
                                <option value="Non binary" {{ old('gender', $user->gender ?? '') == 'Non-Binary/Non-Conforming' ? 'selected' : '' }}>Non-Binary/Non-Conforming</option>
                                <option value="Prefer not to respond" {{ old('gender', $user->gender ?? '') == 'Prefer not to respond' ? 'selected' : '' }}>Prefer not to respond</option>
                            </select>

                            <label class="form-label" for="education">Highest Educational Attainment </label>
                            <select name="education" class="form-control mb-2">
                                <option value="High School" {{ old('education', $user->education ?? '') == 'High School' ? 'selected' : '' }}>High School</option>
                                <option value="Senior High School" {{ old('education', $user->education ?? '') == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                                <option value="College Undergrad" {{ old('education', $user->education ?? '') == 'College Undergrad' ? 'selected' : '' }}>College Undergrad</option>
                                <option value="College Degree" {{ old('education', $user->education ?? '') == 'College Degree' ? 'selected' : '' }}>College Degree</option>
                                <option value="Masters Degree" {{ old('education', $user->education ?? '') == 'Master\'s Degree' ? 'selected' : '' }}>Master's Degree</option>
                                <option value="Professional Degree" {{ old('education', $user->education ?? '') == 'Professional Degree' ? 'selected' : '' }}>Professional Degree</option>
                                <option value="Doctorate Degree" {{ old('education', $user->education ?? '') == 'Doctorate Degree' ? 'selected' : '' }}>Doctorate Degree</option>
                                <option value="Vocational" {{ old('education', $user->education ?? '') == 'Vocational' ? 'selected' : '' }}>Vocational</option>
                            </select>

                            <label class="form-label" for="email">Email Address </label>
                            <input class="form-control mb-2" type="email" name="email" value="{{ $user->email }}" required>

                            <label class="form-label" for="address">Address</label>
                            <input class="form-control mb-2" type="text" name="address" value="{{ $user->address }}" required>

                            <label class="form-label" for="contactnumber">Contact Number</label>
                            <input class="form-control mb-2" type="number" value="{{ $user->contactnumber }}" name="contactnumber" required>
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


<x-administrator-applicant.edit-skillsets :user="$user" :skills="$skills" :websites="$websites" :tools="$tools" :softskills="$softskills" />
{{-- <x-administrator-applicant.edit-files :user="$user"/> --}}
<x-administrator-applicant.edit-profile :user="$user" :skills="$skills"/>
<x-administrator-applicant.edit-password :user="$user"/>
