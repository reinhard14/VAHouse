<!--Edit Profile Modal -->

<div class="modal fade long" id="edit-user-experience-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Employment</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            <div class="modal-body">
                <div class="row text-center mb-5">
                    <div class="col">
                        <div class="btn-group">
                            <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Info</a>
                            <a href="edit-user-profile-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Profile</a>
                            <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Skillset</a>
                            <a href="#" type="button" class="btn btn-secondary btn-flat btn-sm disabled" data-bs-toggle="modal">Employment</a>
                            <a href="#edit-user-references-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">References</a>
                            <a href="#edit-user-files-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Files</a>
                            <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Password</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="text-right mb-3">
                            <button type="submit" id="addExperienceButton-{{ $user->id }}" class="btn btn-outline-primary btn-sm" data-user-id="{{ $user->id }}">Add Employment</button>
                        </div>

                        <form id="add-experience-form-{{ $user->id }}" data-user-id="{{ $user->id }}">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">

                            <div id="modalContent-{{ $user->id }}" class="mb-4">
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead>
                                    <th>Employment Type</th>
                                    <th>Date Started</th>
                                    <th>Date Ended</th>
                                    <th>Job Title</th>
                                    <th>Company Details</th>
                                    <th>Job Details</th>
                                    <th>Delete ?</th>
                                </thead>
                                @forelse ($user->employments as $employment)
                                    <tbody id="experienceRow-{{ $user->id }}">
                                        <tr id="tr_{{ $employment->id }}">
                                            <td>{{ $employment->employment_type }}</td>
                                            <td>{{ $employment->date_started }}</td>
                                            <td>{{ $employment->date_ended }}</td>
                                            <td>{{ $employment->job_position }}</td>
                                            <td>{{ $employment->company_details }}</td>
                                            <td>{{ $employment->job_details }}</td>
                                            <td>{{ $employment->updated_at->shortRelativeDiffForHumans() }}</td>
                                            <td class="text-right">
                                                <form id="delete-experience-form-{{ $employment->id }}" data-employment-id="{{ $employment->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash mr-1"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                    <tbody id="experienceRow-{{ $user->id }}">
                                        <tr id="tr_null_{{ $user->id }}">
                                            <td colspan="7">
                                                <h5 class="text-center p-3">No data available.</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-arrow-return-right mr-1"></i>Close</button>
            </div>
        </div>
    </div>
</div>

