<!--Edit References Modal -->

<div id="edit-user-references-modal-{{ $user->id }}" class="modal fade long" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's References</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            {{-- <form method="POST" action="{{ route('update.user.references', $user->id) }}" class="editUserForm"> --}}
            <form id="edit-references-form-{{ $user->id }}" data-user-id="{{ $user->id }}">

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
                                <a href="#" type="button" class="btn btn-secondary btn-flat btn-sm disabled">References</a>
                                <a href="#edit-user-files-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Files</a>
                                <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Password</a>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="emergency_person" class="form-label">Emergency Person Name </label>
                            <input type="text" name="emergency_person" class="form-control mb-2" value="{{ $user->references->emergency_person ?? '' }}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="emergency_relationship" class="form-label">Emergency Person Relationship  </label>
                            <input type="text" name="emergency_relationship" class="form-control mb-2" value="{{ $user->references->emergency_relationship ?? '' }}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="emergency_number" class="form-label">Emergency Person Number </label>
                            <input type="text" name="emergency_number" class="form-control mb-2" value="{{ $user->references->emergency_number ?? '' }}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="start_date" class="form-label">Start Date </label>
                            <input type="date" name="start_date" class="form-control mb-2" value="{{ $user->references->start_date ?? '' }}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="department" class="form-label">Department </label>
                            <input type="text" name="department" class="form-control mb-2" value="{{ $user->references->department ?? '' }}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="team_leader" class="form-label">Team Leader </label>
                            <input type="text" name="team_leader" class="form-control mb-2" value="{{ $user->references->team_leader ?? '' }}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="referral" class="form-label">Referral </label>
                            <select name="referral" class="form-control">
                                <option value="Facebook" {{ old('referral', $user->references->referral ?? '') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="Referral" {{ old('referral', $user->references->referral ?? '') == 'Referral' ? 'selected' : '' }}>Referral</option>
                                <option value="Onlinejobs.com" {{ old('referral', $user->references->referral ?? '') == 'Onlinejobs.com' ? 'selected' : '' }}>Onlinejobs.com</option>
                                <option value="LinkedIn" {{ old('referral', $user->references->referral ?? '') == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                                <option value="Others" {{ old('referral', $user->references->referral ?? '') == 'Others' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="preferred_shift" class="form-label">Preferred Shift </label>
                            <select name="preferred_shift" class="form-control">
                                <option value="Night Shift" {{ old('referral', $user->references->preferred_shift ?? '') == 'Night Shift' ? 'selected' : '' }}>Night Shift</option>
                                <option value="Day Shift" {{ old('referral', $user->references->preferred_shift ?? '') == 'Day Shift' ? 'selected' : '' }}>Day Shift</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="work_status" class="form-label">Work Status </label>
                            <select name="work_status" class="form-control">
                                <option value="Part-time" {{ old('referral', $user->references->work_status ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Full-time" {{ old('referral', $user->references->work_status ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Hybrid" {{ old('referral', $user->references->work_status ?? '') == 'Hybrid' ? 'selected' : '' }}>Hybrid (Both full-time & part-time for multiple client)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="services_offered" class="form-label">Services Offered</label>
                            @if(is_null($user->references))
                                <select name="services_offered[]" class="form-control select2 services" multiple="multiple">
                                    <option value="General Virtual Assistant">General Virtual Assistant (Cold Calling, Email & Chat Support)</option>
                                    <option value="Social Media Management">Social Media Management</option>
                                    <option value="Accounting and bookkeeping">Accounting and bookkeeping</option>
                                    <option value="Project Management">Project Management</option>
                                    <option value="Team Management">Team Management</option>
                                    <option value="E-commerce">E-commerce</option>
                                    <option value="VA House Admin Staff">VA House Admin Staff</option>
                                    <option value="Graphics & Designs">Graphics & Designs</option>
                                    <option value="Web Management & Development">Web Management & Development</option>
                                    <option value="Others">Others</option>
                                </select>
                            @else
                                <select name="services_offered[]" class="form-control select2 services" multiple="multiple">
                                    @php
                                        $applicantPositions = $user->references->services_offered;
                                        $dynamicPositions = $applicantPositions ?? [];

                                        $staticPositions = [
                                            'General Virtual Assistant',
                                            'Social Media Management',
                                            'Accounting and bookkeeping',
                                            'Project Management',
                                            'Team Management',
                                            'E-commerce',
                                            'VA House Admin Staff',
                                            'Graphics & Designs',
                                            'Web Management & Development',
                                            'Others',
                                        ]  ?? [];

                                        $mergedPositions = array_merge($dynamicPositions, $staticPositions);
                                        $allPositions = array_unique($mergedPositions);
                                    @endphp

                                    @if (!empty($applicantPositions) || is_array($applicantPositions))
                                        @foreach ($allPositions as $position)
                                            <option value="{{ $position }}" {{ in_array($position, $applicantPositions) ? 'selected' : '' }}>{{ $position }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($allPositions as $position)
                                            <option value="{{ $position }}">{{ $position }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @endif
                        </div>
                    </div>

                </div>

                <small class="text-left ml-3">
                    @if (isset($user->information->updated_at))
                        last updated: {{ $user->information->updated_at->diffForHumans() }}
                    @endif
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

