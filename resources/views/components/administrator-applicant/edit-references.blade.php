<!--Edit References Modal -->

<div id="edit-user-references-modal-{{ $user->id }}" class="modal fade long" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's References</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form method="POST" action="{{ route('update.user.references', $user->id) }}" class="editUserForm">
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

                    <div class="row">
                        <div class="col">
                            <label for="emergency_person" class="form-label">Emergency Person Name </label>
                            <input type="text" name="emergency_person" class="form-control mb-2" value="{{ $user->references->emergency_person ?? '' }}" required>

                            <label for="emergency_relationship" class="form-label">Emergency Person Relationship  </label>
                            <input type="text" name="emergency_relationship" class="form-control mb-2" value="{{ $user->references->emergency_relationship ?? '' }}" required>

                            <label for="emergency_number" class="form-label">Emergency Person Number </label>
                            <input type="text" name="emergency_number" class="form-control mb-2" value="{{ $user->references->emergency_number ?? '' }}" required>

                            <label for="start_date" class="form-label">Start Date </label>
                            <input type="date" name="start_date" class="form-control mb-2" value="{{ $user->references->start_date ?? '' }}" required>

                            <label for="department" class="form-label">Department </label>
                            <input type="text" name="department" class="form-control mb-2" value="{{ $user->references->department ?? '' }}" required>

                            <label for="team_leader" class="form-label">Team Leader </label>
                            <input type="text" name="team_leader" class="form-control mb-2" value="{{ $user->references->team_leader ?? '' }}" required>

                            <label for="referral" class="form-label">Referral </label>
                            <input type="text" name="referral" class="form-control mb-2" value="{{ $user->references->referral ?? '' }}" required>

                            <label for="preferred_shift" class="form-label">Preferred Shift </label>
                            <input type="text" name="preferred_shift" class="form-control mb-2" value="{{ $user->references->preferred_shift ?? '' }}" required>

                            <label for="work_status" class="form-label">Work Status </label>
                            <input type="text" name="work_status" class="form-control mb-2" value="{{ $user->references->work_status ?? '' }}" required>

                            <label for="services_offered" class="form-label">Services Offered</label>
                            @if(is_null($user->references))
                                <h5>Not available</h5>
                            @else
                                <select id="services_offered" name="services_offered[]" class="form-control select2 positions" multiple="multiple">
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

