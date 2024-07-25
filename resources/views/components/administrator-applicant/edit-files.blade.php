<!--Edit Files Modal -->

<div class="modal fade long" id="edit-user-files-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <div class="modal-body">
                <div class="row text-center mb-5">
                    <div class="col">
                        <div class="btn-group">
                            <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Personal</a>
                            <a href="#edit-user-profile-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Profile</a>
                            <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Skillset</a>
                            <a href="#" type="button" class="btn btn-secondary btn-flat disabled">Files</a>
                            <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal">Password</a>
                        </div>
                    </div>
                </div>

                @if(!isset($user->information))
                    <h4 class="text-center mb-3">Applicant did not submit form yet.</h4>
                @else
                    <div class="row pb-3">
                        <div class="col">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-4">
                                    <label class="form-label">Intro Video </label>
                                </div>
                                    @if(!isset($user->information->videolink) && is_null($user->information->videolink))
                                        <div class="col text-right">
                                            <span class="p-1 badge badge-danger"> N/A </span>
                                        </div>
                                    @else
                                        <div class="col-md-4 text-right">
                                            <a href="{{ route('view.pdf', $user->information->videolink)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                        </div>
                                        @if(isset($user->information->videolink) && !is_null($user->information->videolink))
                                            <div class="col-md-4 text-right">
                                                <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->information->id, 'field' => 'videolink']) }}" class="deleteAdminForm filesDelete">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                        Delete <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                            </div>
                            <div class="row">
                                <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->information->id, 'field' => 'videolink']) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-8">
                                        <input name="videolink" type="file" accept=".mp4, .avi, .mkv, .mov, .wmv, .flv, .webm, .mpeg" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                            Update <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">
                        <div class="col">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-4">
                                    <label class="form-label">Resume </label>
                                </div>
                                    @if(!isset($user->information->resume) && is_null($user->information->resume))
                                        <div class="col text-right">
                                            <span class="p-1 badge badge-danger"> N/A </span>
                                        </div>
                                    @else
                                        <div class="col-md-4 text-right">
                                            <a href="{{ route('view.pdf', $user->information->resume)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                        </div>
                                        @if(isset($user->information->resume) && !is_null($user->information->resume))
                                            <div class="col-md-4 text-right">
                                                <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->information->id, 'field' => 'resume']) }}" class="deleteAdminForm filesDelete">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                        Delete <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                            </div>
                            <div class="row">
                                <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->information->id, 'field' => 'resume']) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-8">
                                        <input name="resume" type="file" accept="application/pdf" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                            Update <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">
                        <div class="col">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-4">
                                    <label class="form-label">Portfolio </label>
                                </div>
                                    @if(!isset($user->information->portfolio) && is_null($user->information->portfolio))
                                        <div class="col text-right">
                                            <span class="p-1 badge badge-danger"> N/A </span>
                                        </div>
                                    @else
                                        <div class="col-md-4 text-right">
                                            <a href="{{ route('view.pdf', $user->information->portfolio)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                        </div>
                                        @if(isset($user->information->portfolio) && !is_null($user->information->portfolio))
                                            <div class="col-md-4 text-right">
                                                <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->information->id, 'field' => 'portfolio']) }}" class="deleteAdminForm filesDelete">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                        Delete <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                            </div>
                            <div class="row">
                                <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->information->id, 'field' => 'portfolio']) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-8">
                                        <input name="portfolio" id="portfolio" type="file" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                            Update <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">
                        <div class="col">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-4">
                                    <label class="form-label">IDs </label>
                                </div>
                                    @if(!isset($user->information->photo_id) && is_null($user->information->photo_id))
                                        <div class="col text-right">
                                            <span class="p-1 badge badge-danger"> N/A </span>
                                        </div>
                                    @else
                                        <div class="col-md-4 text-right">
                                            <a href="{{ route('view.pdf', $user->information->photo_id)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                        </div>
                                        @if(isset($user->information->photo_id) && !is_null($user->information->photo_id))
                                            <div class="col-md-4 text-right">
                                                <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->information->id, 'field' => 'photo_id']) }}" class="deleteAdminForm filesDelete">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                        Delete <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                            </div>
                            <div class="row">
                                <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->information->id, 'field' => 'photo_id']) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-8">
                                        <input name="photo_id" type="file" accept=".jpeg, .jpg, .png, .pdf" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                            Update <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">
                        <div class="col">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-4">
                                    <label class="form-label">Formal Photo </label>
                                </div>
                                    @if(!isset($user->information->photo_formal) && is_null($user->information->photo_formal))
                                        <div class="col text-right">
                                            <span class="p-1 badge badge-danger"> N/A </span>
                                        </div>
                                    @else
                                        <div class="col-md-4 text-right">
                                            <a href="{{ route('view.pdf', $user->information->photo_formal)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                        </div>
                                        @if(isset($user->information->photo_formal) && !is_null($user->information->photo_formal))
                                            <div class="col-md-4 text-right">
                                                <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->information->id, 'field' => 'photo_formal']) }}" class="deleteAdminForm filesDelete">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                        Delete <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                            </div>
                            <div class="row">
                                <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->information->id, 'field' => 'photo_formal']) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-8">
                                        <input name="photo_formal" type="file" accept=".jpeg, .jpg, .png" class="form-control" required>

                                    </div>
                                    <div class="col-md-4 text-right">
                                        <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                            Update <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">
                        <div class="col">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-4">
                                    <label class="form-label">DISC Results </label>
                                </div>
                                    @if(!isset($user->information->disc_results) && is_null($user->information->disc_results))
                                        <div class="col text-right">
                                            <span class="p-1 badge badge-danger"> N/A </span>
                                        </div>
                                    @else
                                        <div class="col-md-4 text-right">
                                            <a href="{{ route('view.pdf', $user->information->disc_results)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                        </div>
                                        @if(isset($user->information->disc_results) && !is_null($user->information->disc_results))
                                            <div class="col-md-4 text-right">
                                                <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->information->id, 'field' => 'disc_results']) }}" class="deleteAdminForm filesDelete">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                        Delete <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                            </div>
                            <div class="row">
                                <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->information->id, 'field' => 'disc_results']) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-8">
                                        <input name="disc_results" type="file" accept="application/pdf" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                            Update <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>

                    @if(isset($user->mockcalls))
                        <div class="row pb-3">
                            <div class="col">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Mock Calls:</label>
                                        <label class="form-label">Inbound</label>
                                    </div>
                                        @if(!isset($user->mockcalls->inbound_call) && is_null($user->mockcalls->inbound_call))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col-md-4 text-right">
                                                <a href="{{ route('view.pdf', $user->mockcalls->inbound_call)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->mockcalls->inbound_call) && !is_null($user->mockcalls->inbound_call))
                                                <div class="col-md-4 text-right">
                                                    <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->mockcalls->id, 'field' => 'inbound_call']) }}" class="deleteAdminForm filesDelete">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                            Delete <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                </div>
                                <div class="row">
                                    <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->mockcalls->id, 'field' => 'inbound_call']) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-8">
                                            <input name="inbound_call" type="file" class="form-control" required>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                                Update <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Outbound</label>
                                    </div>
                                        @if(!isset($user->mockcalls->outbound_call) && is_null($user->mockcalls->outbound_call))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col-md-4 text-right">
                                                <a href="{{ route('view.pdf', $user->mockcalls->outbound_call)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->mockcalls->outbound_call) && !is_null($user->mockcalls->outbound_call))
                                                <div class="col-md-4 text-right">
                                                    <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->mockcalls->id, 'field' => 'outbound_call']) }}" class="deleteAdminForm filesDelete">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                            Delete <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                </div>
                                <div class="row">
                                    <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->mockcalls->id, 'field' => 'outbound_call']) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-8">
                                            <input name="outbound_call" type="file" class="form-control" required>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                                Update <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                @endif
            </div>
            <small class="text-left ml-3">
                @if (isset($user->skillsets->updated_at))
                    last updated: {{ $user->skillsets->updated_at->diffForHumans() }}
                @endif
            </small>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-arrow-return-right mr-1"></i>Close</button>
            </div>
        </div>
    </div>
</div>

