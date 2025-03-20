<form action="{{ route('user.update-personal-details', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-4">
        <div class="col">
            <label for="photo_formal" class="custom-label">2x2 Formal Photo</label>
            <input type="file" id="photo_formal" name="photo_formal" class="form-control" accept=".jpeg, .jpg, .png" required>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="custom-label">{{ __('First Name') }} <span class="text-danger">*</span> </label>

                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name ?? '' }}" required>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="middlename" class="custom-label">Middle Name: <span class="text-danger">*</span> </label>

                <input type="text" id="middlename" name="middlename" class="form-control" value="{{ $user->middlename ?? '' }}" required>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="lastname" class="custom-label">{{ __('Last name') }} <span class="text-danger">*</span></label>

                <input id="lastname" type="text" name="lastname" class="form-control" value="{{ $user->lastname ?? '' }}" required>

                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="suffix" class="custom-label">Suffix </label>

                <input id="suffix" type="text" name="suffix" class="form-control @error('suffix') is-invalid @enderror" value="{{ $user->suffix ?? '' }}">

                @error('suffix')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-2">

        <div class="col-md-6">
            <div class="form-group">
                <label for="birthdate" class="custom-label">{{ __('Birthdate') }} <span class="text-danger">*</span></label>

                <input id="birthdate" type="date" name="birthdate" class="form-control" value="{{ $user->age }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="gender" class="custom-label">Gender <span class="text-danger">*</span></label>

                <select name="gender" class="form-control">
                    <option value="Male" {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }} >Female</option>
                    <option value="Transgender" {{ old('gender', $user->gender ?? '') == 'Transgender' ? 'selected' : '' }} >Transgender</option>
                    <option value="Non binary" {{ old('gender', $user->gender ?? '') == 'Non binary' ? 'selected' : '' }} >Non-Binary/Non-Conforming</option>
                    <option value="Prefer not to respond" {{ old('gender', $user->gender ?? '') == 'Prefer not to respond' ? 'selected' : '' }} >Prefer not to respond</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mb-3 border-bottom">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nationality" class="custom-label">Nationality <span class="text-danger">*</span></label>

                <input id="nationality" type="text" name="nationality" class="form-control" value="{{ $user->nationality ?? '' }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="civil_status" class="custom-label">Civil Status <span class="text-danger">*</span></label>

                <select name="civil_status" class="form-control">
                    <option value="Single" {{ old('status', $user->civil_status ?? '') == 'Single' ? 'selected' : '' }} >Single</option>
                    <option value="Married" {{ old('status', $user->civil_status ?? '') == 'Married' ? 'selected' : '' }} >Married</option>
                    <option value="Widowed" {{ old('status', $user->civil_status ?? '') == 'Widowed' ? 'selected' : '' }} >Widowed</option>
                    <option value="Separated" {{ old('status', $user->civil_status ?? '') == 'Separated' ? 'selected' : '' }} >Separated</option>
                    <option value="Divorced" {{ old('status', $user->civil_status ?? '') == 'Divorced' ? 'selected' : '' }} >Divorced</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <h5>Contact Information</h5>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="contactnumber" class="custom-label">Mobile Number <span class="text-danger">*</span> </label>

                <input id="contactnumber" type="text" name="contactnumber" class="form-control" value="{{ $user->contactnumber ?? '' }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="custom-label">Email Address <span class="text-danger">*</span> </label>

                <input type="text" id="email" name="email" class="form-control" value="{{ $user->email ?? '' }}" required>
            </div>
        </div>
    </div>

    <div class="row mb-3 border-bottom">
        <div class="col-md-6">
            <div class="form-group">
                <label for="skype" class="custom-label">Skype <span class="text-danger">*</span> </label>

                <input id="skype" type="text" name="skype" class="form-control" value="{{ $user->information->skype ?? '' }}" required>
                <small class="text-muted">Find your Skype ID next to "Skype Name". It's under the "Profile" header.</small>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="address" class="custom-label">Address <span class="text-danger">*</span> </label>

                <input id="address" type="text" name="address" class="form-control" value="{{ $user->address ?? '' }}" required>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <h5>Emergency Contact Information</h5>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="emergency_person" class="custom-label">Parent/Guardian Name <span class="text-danger">*</span> </label>

                <input type="text" id="emergency_person" name="emergency_person" class="form-control" value="{{ $user->references->emergency_person ?? '' }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="emergency_number" class="custom-label">Contact Number <span class="text-danger">*</span> </label>

                <input type="text" id="emergency_number" name="emergency_number" class="form-control" value="{{ $user->references->emergency_number ?? '' }}" required>
            </div>
        </div>
    </div>

    <div class="row mb-3 border-bottom">
        <div class="col-md-6">
            <div class="form-group">
                <label for="emergency_relationship" class="custom-label">Relationship <span class="text-danger">*</span> </label>

                <input type="text" id="emergency_relationship" name="emergency_relationship" class="form-control" value="{{ $user->references->emergency_relationship ?? '' }}" required>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <h5>Disbursement Information</h5>
        </div>
    </div>

    <div class="row mb-3 border-bottom">
        <div class="col-md-6">
            <div class="form-group">
                <label for="ub_account" class="custom-label">UnionBank Account Name <span class="text-danger">*</span> </label>

                <input type="text" id="ub_account" name="ub_account" class="form-control" value="{{ $user->information->ub_account ?? '' }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="ub_number" class="custom-label">UnionBank Account Number <span class="text-danger">*</span> </label>

                <input type="text" id="ub_number" name="ub_number" class="form-control" value="{{ $user->information->ub_number ?? '' }}" required>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <h5>Education</h5>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="education" class="custom-label">Highest Education Attainment <span class="text-danger">*</span> </label>

                <select name="education" class="form-control">
                    <option value="High School" {{ old('education', $user->education ?? '') == 'High School' ? 'selected' : '' }} >High School</option>
                    <option value="Senior High School" {{ old('education', $user->education ?? '') == 'Senior High School' ? 'selected' : '' }} >Senior High School</option>
                    <option value="College Undergrad" {{ old('education', $user->education ?? '') == 'College Undergrad' ? 'selected' : '' }} >College Undergrad</option>
                    <option value="College Degree" {{ old('education', $user->education ?? '') == 'College Degree' ? 'selected' : '' }} >College Degree</option>
                    <option value="Master's Degree" {{ old('education', $user->education ?? '') == 'Master\'s Degree' ? 'selected' : '' }} >Master's Degree</option>
                    <option value="Professional Degree" {{ old('education', $user->education ?? '') == 'Professional Degree' ? 'selected' : '' }} >Professional Degree</option>
                    <option value="Doctorate Degree" {{ old('education', $user->education ?? '') == 'Doctorate Degree' ? 'selected' : '' }} >Doctorate Degree</option>
                    <option value="Vocational" {{ old('education', $user->education ?? '') == 'Vocational' ? 'selected' : '' }} >Vocational</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="degree" class="custom-label">Degree <span class="text-danger">*</span> </label>

                <input type="text" id="degree" name="degree" class="form-control" value="{{ $user->degree ?? '' }}" required>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Previous</a>
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-orange-flat">Next Step</button>
        </div>
    </div>
</form>
