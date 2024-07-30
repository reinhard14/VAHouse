<!--Edit Profile Modal -->

<div class="modal fade long" id="edit-user-references-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's References</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editUserForm" method="POST" action="{{ route('update.user.profile', $user->id) }}">
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
                            <label class="form-label" for="rate">Emergency Person Name </label>
                            <input class="form-control mb-2" type="text" name="rate" value="{{ $user->references->emergency_person ?? '' }}" required>

                            <label class="form-label" for="experience">Emergency Person Relationship  </label>
                            <input class="form-control mb-2" type="number" name="experience" value="{{ $user->references->emergency_relationship ?? '' }}" required>

                            <label class="form-label" for="skype">Emergency Person Number </label>
                            <input class="form-control mb-2" type="text" name="skype" value="{{ $user->references->emergency_number ?? '' }}" required>

                            <label class="form-label" for="niche">Start Date </label>
                            <input class="form-control mb-2" type="text" name="niche" value="{{ $user->references->start_date ?? '' }}" required>

                            <label class="form-label" for="ub_account">Department </label>
                            <input class="form-control mb-2" type="text" name="ub_account" value="{{ $user->references->department ?? '' }}" required>

                            <label class="form-label" for="ub_number">Team Leader </label>
                            <input class="form-control mb-2" type="text" name="ub_number" value="{{ $user->references->team_leader ?? '' }}" required>

                            <label class="form-label" for="ub_number">Referral </label>
                            <input class="form-control mb-2" type="text" name="ub_number" value="{{ $user->references->referral ?? '' }}" required>

                            <label class="form-label" for="ub_number">Preferred Shift </label>
                            <input class="form-control mb-2" type="text" name="ub_number" value="{{ $user->references->preferred_shift ?? '' }}" required>

                            <label class="form-label" for="ub_number">Work Status </label>
                            <input class="form-control mb-2" type="text" name="ub_number" value="{{ $user->references->work_status ?? '' }}" required>

                            <label class="form-label" for="positions">Services Offered</label>
                            @if(is_null($user->references))
                                <h5>Not available</h5>
                            @else
                                <select class="form-control select2 positions" name="positions[]" multiple="multiple">
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
                    {{-- <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> Update
                    </button> --}}
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-arrow-return-right mr-1"></i>Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

