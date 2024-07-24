<!--Edit Files Modal -->

<div class="modal fade long" id="edit-user-files-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal">x</button>
            </div>

            <form class="editUserForm" method="POST" action="{{ route('update.user.files', $user->id) }}">
                @csrf
                @method('PUT')

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
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Introduction Video </label>
                                    </div>
                                    @if(!isset($user->information))
                                        <p>Don't Information exists.</p>
                                    @else
                                        @if(!isset($user->information->videolink) && is_null($user->information->videolink))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col text-right">
                                                <a href="{{ route('view.pdf', $user->information->videolink)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->information->videolink) && !is_null($user->information->videolink))
                                                <div class="col-md-3 text-right">
                                                    <a href="#" class="p-1 text-danger">Delete <i class="bi bi-trash"></i> </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endif

                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <input id="inbound_call" name="inbound_call" type="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Resume </label>
                                    </div>
                                    @if(!isset($user->information))
                                        <p>Information doesn't exists.</p>
                                    @else
                                        @if(is_null($user->information->resume) && !isset($user->information->resume))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col text-right">
                                                <a href="{{ route('view.pdf', $user->information->resume)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->information->resume) && !is_null($user->information->resume))
                                                <div class="col-md-3 text-right">
                                                    <a href="#" class="p-1 text-danger">Delete <i class="bi bi-trash"></i> </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <input id="inbound_call" name="inbound_call" type="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Portfolio </label>
                                    </div>
                                    @if(!isset($user->information))
                                        <p>Information doesn't exists.</p>
                                    @else
                                        @if(is_null($user->information->portfolio) && !isset($user->information->portfolio))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col text-right">
                                                <a href="{{ route('view.pdf', $user->information->portfolio)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->information->portfolio) && !is_null($user->information->portfolio))
                                                <div class="col-md-3 text-right">
                                                    <a href="#" class="p-1 text-danger">Delete <i class="bi bi-trash"></i> </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <input id="inbound_call" name="inbound_call" type="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">IDs </label>
                                    </div>
                                    @if(!isset($user->information))
                                        <p>Information doesn't exists.</p>
                                    @else
                                        @if(is_null($user->information->photo_id) && !isset($user->information->photo_id))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col text-right">
                                                <a href="{{ route('view.pdf', $user->information->photo_id)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->information->photo_id) && !is_null($user->information->photo_id))
                                                <div class="col-md-3 text-right">
                                                    <a href="#" class="p-1 text-danger">Delete <i class="bi bi-trash"></i> </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <input id="inbound_call" name="inbound_call" type="file" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Formal Photo </label>
                                    </div>
                                    @if(!isset($user->information))
                                        <p>Information doesn't exists.</p>
                                    @else
                                        @if(is_null($user->information->photo_formal) && !isset($user->information->photo_formal))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col text-right">
                                                <a href="{{ route('view.pdf', $user->information->photo_formal)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->information->photo_formal) && !is_null($user->information->photo_formal))
                                                <div class="col-md-3 text-right">
                                                    <a href="#" class="p-1 text-danger">Delete <i class="bi bi-trash"></i> </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <input id="inbound_call" name="inbound_call" type="file" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">DISC Results </label>
                                    </div>
                                    @if(!isset($user->information))
                                        <p>Information doesn't exists.</p>
                                    @else
                                        @if(is_null($user->information->disc_results) && !isset($user->information->disc_results))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col text-right">
                                                <a href="{{ route('view.pdf', $user->information->disc_results)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->information->disc_results) && !is_null($user->information->disc_results))
                                                <div class="col-md-3 text-right">
                                                    <a href="#" class="p-1 text-danger">Delete <i class="bi bi-trash"></i> </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <input id="inbound_call" name="inbound_call" type="file" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>

                        @if(isset($user->mockcalls))
                            <div class="row pb-3">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Mock Calls </label>
                                        </div>
                                        @if(is_null($user->information->disc_results) && !isset($user->information->disc_results))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col text-right">
                                                <a href="{{ route('view.pdf', $user->information->disc_results)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->information->disc_results) && !is_null($user->information->disc_results))
                                                <div class="col-md-3 text-right">
                                                    <a href="#" class="p-1 text-danger">Delete <i class="bi bi-trash"></i> </a>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input id="inbound_call" name="inbound_call" type="file" class="form-control">
                                        </div>
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
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> Update
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-arrow-return-right mr-1"></i>Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

