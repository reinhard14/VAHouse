<!--Edit UModal -->

<div class="modal fade" id="edit-user-files-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editUserForm" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row text-center mb-3">
                        <div class="col">
                            <div class="btn-group">
                                <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Personal</a>
                                <a href="#edit-user-profile-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Profile</a>
                                <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Skillset</a>
                                <a href="#" type="button" class="btn btn-secondary btn-flat disabled">Files</a>
                            </div>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col">
                            <label class="form-label">Introduction Video </label>
                        </div>
                        <div class="col text-right">
                            @if(is_null($user->information->videolink) && !isset($user->information->videolink))
                                <span class="p-1 badge badge-danger"> N/A </span>
                            @else
                                <a href="{{ route('view.pdf', $user->information->videolink)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                            @endif
                            <a href="#" class="p-1">Upload <i class="bi bi-cloud-upload"></i></a>
                            <a href="#" class="p-1 text-danger"><i class="bi bi-trash mr-1"></i> </a>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col">
                            <label class="form-label">Resume </label>
                        </div>
                        <div class="col text-right">
                            @if(is_null($user->information->resume) && !isset($user->information->resume))
                                <span class="p-1 badge badge-danger"> N/A </span>
                            @else
                                <a href="{{ route('view.pdf', $user->information->resume)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                            @endif
                            <a href="#" class="p-1">Upload <i class="bi bi-cloud-upload"></i></a>
                            <a href="#" class="p-1 text-danger"><i class="bi bi-trash mr-1"></i> </a>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col">
                            <label class="form-label">Portfolio </label>
                        </div>
                        <div class="col text-right">
                            @if(is_null($user->information->portfolio) && !isset($user->information->portfolio))
                                <span class="p-1 badge badge-danger"> N/A </span>
                            @else
                                <a href="{{ route('view.pdf', $user->information->portfolio)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                            @endif
                            <a href="#" class="p-1">Upload <i class="bi bi-cloud-upload"></i></a>
                            <a href="#" class="p-1 text-danger"><i class="bi bi-trash mr-1"></i> </a>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col">
                            <label class="form-label">IDs </label>
                        </div>
                        <div class="col text-right">
                            @if(is_null($user->information->photo_id) && !isset($user->information->photo_id))
                                <span class="p-1 badge badge-danger"> N/A </span>
                            @else
                                <a href="{{ route('view.pdf', $user->information->photo_id)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                            @endif
                            <a href="#" class="p-1">Upload <i class="bi bi-cloud-upload"></i></a>
                            <a href="#" class="p-1 text-danger"><i class="bi bi-trash mr-1"></i> </a>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col">
                            <label class="form-label">Formal Photo </label>
                        </div>
                        <div class="col text-right">
                            @if(is_null($user->information->photo_formal) && !isset($user->information->photo_formal))
                                <span class="p-1 badge badge-danger"> N/A </span>
                            @else
                                <a href="{{ route('view.pdf', $user->information->photo_formal)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                            @endif
                            <a href="#" class="p-1">Upload <i class="bi bi-cloud-upload"></i></a>
                            <a href="#" class="p-1 text-danger"><i class="bi bi-trash mr-1"></i> </a>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col">
                            <label class="form-label">DISC Results </label>
                        </div>
                        <div class="col text-right">
                            @if(is_null($user->information->disc_results) && !isset($user->information->disc_results))
                                <span class="p-1 badge badge-danger"> N/A </span>
                            @else
                                <a href="{{ route('view.pdf', $user->information->disc_results)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                            @endif
                            <a href="#" class="p-1">Upload <i class="bi bi-cloud-upload"></i></a>
                            <a href="#" class="p-1 text-danger"><i class="bi bi-trash mr-1"></i> </a>
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

