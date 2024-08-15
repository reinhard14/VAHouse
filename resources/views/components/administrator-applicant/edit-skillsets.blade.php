<!--Edit Skillset Modal -->

<div class="modal fade long" id="edit-user-skillsets-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Skillsets</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            {{-- <form class="editUserForm" method="POST" action="{{ route('update.user.skillsets', $user->id) }}"> --}}
            <form id="edit-skillset-form-{{ $user->id }}" data-user-id="{{ $user->id }}">

                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row text-center mb-5">
                        <div class="col">
                            <div class="btn-group">
                                <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Info</a>
                                <a href="#edit-user-profile-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Profile</a>
                                <a href="#" type="button" class="btn btn-secondary btn-flat btn-sm disabled">Skillset</a>
                                <a href="#edit-user-experience-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Experiences</a>
                                <a href="#edit-user-references-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">References</a>
                                <a href="#edit-user-files-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Files</a>
                                <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Password</a>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            @php
                                $applicantSkills = [];

                                if (isset($user->skillsets->skill) && !is_null($user->skillsets->skill)) {
                                    $applicantSkills = json_decode($user->skillsets->skill, true);
                                }
                            @endphp

                            <label class="form-label" for="name">Skills </label>

                            <select class="form-control select2 skillsets" name="skills[]" multiple="multiple">
                                @if (!empty($applicantSkills) && is_array($applicantSkills))
                                    @foreach ($applicantSkills as $skill)
                                        <option value="{{ $skill }}" selected>{{ $skill }}</option>
                                    @endforeach

                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill }}">{{ $skill }}</option>
                                    @endforeach
                                @else
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill }}">{{ $skill }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            @php
                                $applicantTools = [];

                                if (isset($user->skillsets->tool) && !is_null($user->skillsets->tool)) {
                                    $applicantTools = json_decode($user->skillsets->tool, true);
                                }
                            @endphp

                            <label class="form-label" for="name">Tools </label>

                            <select class="form-control select2 skillsets" name="tools[]" multiple="multiple">
                                @if (!empty($applicantTools) && is_array($applicantTools))
                                    @foreach ($applicantTools as $tool)
                                        <option value="{{ $tool }}" selected>{{ $tool }}</option>
                                    @endforeach

                                    @foreach ($tools as $tool)
                                        <option value="{{ $tool }}">{{ $tool }}</option>
                                    @endforeach
                                @else
                                    @foreach ($tools as $tool)
                                        <option value="{{ $tool }}">{{ $tool }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            @php
                                $applicantWebsites = [];

                                if (isset($user->skillsets->website) && !is_null($user->skillsets->website)) {
                                    $applicantWebsites = json_decode($user->skillsets->website, true);
                                }
                            @endphp

                            <label class="form-label" for="name">Websites </label>

                            <select class="form-control select2 skillsets" name="websites[]" multiple="multiple">
                                @if (!empty($applicantWebsites) && is_array($applicantWebsites))
                                    @foreach ($applicantWebsites as $website)
                                        <option value="{{ $website }}" selected>{{ $website }}</option>
                                    @endforeach

                                    @foreach ($websites as $website)
                                        <option value="{{ $website }}">{{ $website }}</option>
                                    @endforeach
                                @else
                                    @foreach ($websites as $website)
                                        <option value="{{ $website }}">{{ $website }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            @php
                                $applicantSoftskill = [];

                                if (isset($user->skillsets->softskill) && !is_null($user->skillsets->softskill)) {
                                    $applicantSoftskill = json_decode($user->skillsets->softskill, true);
                                }
                            @endphp

                            <label class="form-label" for="name">Softskill </label>

                            <select class="form-control select2 skillsets" name="softskills[]" multiple="multiple">
                                @if (!empty($applicantSoftskill) && is_array($applicantSoftskill))
                                    @foreach ($applicantSoftskill as $softskill)
                                        <option value="{{ $softskill }}" selected>{{ $softskill }}</option>
                                    @endforeach

                                    @foreach ($softskills as $softskill)
                                        <option value="{{ $softskill }}">{{ $softskill }}</option>
                                    @endforeach
                                @else
                                    @foreach ($softskills as $softskill)
                                        <option value="{{ $softskill }}">{{ $softskill }}</option>
                                    @endforeach
                                @endif
                            </select>

                        </div>
                    </div>
                </div>

                <small class="text-left ml-3">
                    @if (isset($user->skillsets->updated_at))
                        last updated: {{ $user->skillsets->updated_at->diffForHumans() }}
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

