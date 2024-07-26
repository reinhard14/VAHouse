<!--Edit Profile Modal -->

<div class="modal fade long" id="edit-user-profile-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's VA Profile</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editUserForm" method="POST" action="{{ route('update.user.profile', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row text-center mb-5">
                        <div class="col">
                            <div class="btn-group">
                                <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Personal</a>
                                <a href="#" type="button" class="btn btn-secondary btn-flat btn-sm disabled" data-bs-toggle="modal">Profile</a>
                                <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Skillset</a>
                                <a href="#edit-user-experience-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Experiences</a>
                                <a href="#edit-user-files-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Files</a>
                                <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Password</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="rate">Rate </label>
                            <input class="form-control mb-2" type="text" name="rate" value="{{ $user->information->rate ?? '' }}" required>

                            <label class="form-label" for="experience">Experience </label>
                            <input class="form-control mb-2" type="number" name="experience" value="{{ $user->information->experience ?? '' }}" required>

                            <label class="form-label" for="skype">Skype </label>
                            <input class="form-control mb-2" type="text" name="skype" value="{{ $user->information->skype ?? '' }}" required>

                            <label class="form-label" for="niche">Niche </label>
                            <input class="form-control mb-2" type="text" name="niche" value="{{ $user->information->niche ?? '' }}" required>

                            <label class="form-label" for="ub_account">Union Bank Name </label>
                            <input class="form-control mb-2" type="text" name="ub_account" value="{{ $user->information->ub_account ?? '' }}" required>

                            <label class="form-label" for="ub_number">Union Bank Account </label>
                            <input class="form-control mb-2" type="text" name="ub_number" value="{{ $user->information->ub_number ?? '' }}" required>

                            <label class="form-label" for="positions">Positions</label>
                            @php
                                $applicantPositions = [];

                                if (isset($user->information->positions) && !is_null($user->information->positions)) {
                                    $applicantPositions = json_decode($user->information->positions, true);
                                }
                            @endphp

                            <select class="form-control select2 positions" name="positions[]" multiple="multiple">
                                @php
                                    $dynamicPositions = $applicantPositions;

                                    $staticPositions = [
                                        'General Virtual Assistant',
                                        'Social Media Manager',
                                        'Callers',
                                        'Web Developers',
                                        'Tech VAs',
                                        'Project Manager',
                                    ];

                                    $allPositions = array_unique(array_merge($dynamicPositions, $staticPositions));
                                @endphp

                                @if (!empty($applicantPositions) && is_array($applicantPositions))
                                    @foreach ($allPositions as $position)
                                        <option value="{{ $position }}" {{ in_array($position, $applicantPositions) ? 'selected' : '' }}>{{ $position }}</option>
                                    @endforeach
                                @else
                                    @foreach ($allPositions as $position)
                                        <option value="{{ $position }}">{{ $position }}</option>
                                    @endforeach
                                @endif
                            </select>
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

