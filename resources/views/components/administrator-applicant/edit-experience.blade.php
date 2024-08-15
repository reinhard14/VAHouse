<!--Edit Profile Modal -->

<div class="modal fade long" id="edit-user-experience-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Experiences</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            {{-- <form class="editUserForm" method="POST" action="{{ route('update.user.profile', $user->id) }}"> --}}
            <form id="edit-experience-form-{{ $user->id }}" data-user-id="{{ $user->id }}">

                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row text-center mb-5">
                        <div class="col">
                            <div class="btn-group">
                                <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Info</a>
                                <a href="edit-user-profile-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Profile</a>
                                <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Skillset</a>
                                <a href="#" type="button" class="btn btn-secondary btn-flat btn-sm disabled" data-bs-toggle="modal">Experiences</a>
                                <a href="#edit-user-references-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">References</a>
                                <a href="#edit-user-files-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Files</a>
                                <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Password</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover border">
                                    <thead>
                                        <th>Job Experience</th>
                                        <th>Duration</th>
                                        <th>Last Updated</th>
                                        <th>Delete ?</th>
                                    </thead>
                                    @forelse ($user->experiences as $experience)
                                        <tbody>
                                            <tr>
                                                <td>{{ $experience->title }}</td>
                                                <td>{{ $experience->duration }}</td>
                                                <td>{{ $experience->updated_at->shortRelativeDiffForHumans() }}</td>
                                                <td class="text-right">
                                                    <form method="POST" action="{{ route('update.user.deleteExperience', $experience->id) }}" class="deleteItemPrompt">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="display" value="{{ request('display') }}">
                                                        <input type="hidden" name="sortByFirstname" value="{{ request('sortByFirstname') }}">
                                                        <input type="hidden" name="sortByLastname" value="{{ request('sortByLastname') }}">
                                                        <input type="hidden" name="sortByDateSubmitted" value="{{ request('sortByDateSubmitted') }}">
                                                        <input type="hidden" name="page" value="{{ request('page') }}">
                                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash mr-1"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                <h5 class="text-center p-3">No data available.</h5>
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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

