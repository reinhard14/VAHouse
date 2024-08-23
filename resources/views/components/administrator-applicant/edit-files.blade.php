<!--Edit Files Modal -->

<div class="modal fade long" id="edit-user-files-modal-{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Applicant's Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            <div class="modal-body">
                <div class="row text-center mb-5">
                    <div class="col">
                        <div class="btn-group">
                            <a href="#edit-user-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Info</a>
                            <a href="#edit-user-profile-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Profile</a>
                            <a href="#edit-user-skillsets-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Skillset</a>
                            <a href="#edit-user-experience-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Experiences</a>
                            <a href="#edit-user-references-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">References</a>
                            <a href="#" type="button" class="btn btn-secondary btn-flat btn-sm disabled">Files</a>
                            <a href="#edit-user-password-modal-{{ $user->id }}" type="button" class="btn btn-secondary btn-flat btn-sm" data-bs-toggle="modal">Password</a>
                        </div>
                    </div>
                </div>

                @if(!isset($user->information))
                    <h4 class="text-center mb-3">Applicant did not submit form yet.</h4>
                @else
                    @php
                        $informationFields = ['videolink', 'resume', 'portfolio', 'photo_id', 'photo_formal', 'disc_results'];
                        $informationLabel = [
                                            'videolink' => 'Intro Video',
                                            'resume' => 'Resume',
                                            'portfolio' => 'Portfolio',
                                            'photo_id' => 'ID',
                                            'photo_formal' => 'Formal Photo',
                                            'disc_results' => 'DISC Results'
                                            ];
                        $informationAcceptType = [
                                            'videolink' => '.mp4, .avi, .mkv, .mov, .wmv, .flv, .webm, .mpeg',
                                            'resume' => 'application/pdf',
                                            'portfolio' => '',
                                            'photo_id' => '.jpeg, .jpg, .png, .pdf',
                                            'photo_formal' => '.jpeg, .jpg, .png',
                                            'disc_results' => 'application/pdf'
                                            ];
                    @endphp

                    @foreach ($informationFields as $field)
                        <div class="row pb-3">
                            <div class="col">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">{{ $informationLabel[$field] }} </label>
                                    </div>
                                        @if(!isset($user->information->$field) && is_null($user->information->$field))
                                            <div class="col text-right">
                                                <span class="p-1 badge badge-danger"> N/A </span>
                                            </div>
                                        @else
                                            <div class="col-md-4 text-right">
                                                <a href="{{ route('view.pdf', $user->information->$field)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                            </div>
                                            @if(isset($user->information->$field) && !is_null($user->information->$field))
                                                <div class="col-md-4 text-right">
                                                    <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->information->id, 'field' => $field]) }}" class="deleteItemPrompt">
                                                    {{-- <form id="delete-files-form-{{ $user->id }}" data-user-id="{{ $user->id }}">   --}}
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="display" value="{{ request('display') }}">
                                                        <input type="hidden" name="sortByFirstname" value="{{ request('sortByFirstname') }}">
                                                        <input type="hidden" name="sortByLastname" value="{{ request('sortByLastname') }}">
                                                        <input type="hidden" name="sortByDateSubmitted" value="{{ request('sortByDateSubmitted') }}">
                                                        <input type="hidden" name="page" value="{{ request('page') }}">
                                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                                        <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                            Delete <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                </div>
                                <div class="row">
                                    <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->information->id, 'field' => $field]) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="display" value="{{ request('display') }}">
                                        <input type="hidden" name="sortByFirstname" value="{{ request('sortByFirstname') }}">
                                        <input type="hidden" name="sortByLastname" value="{{ request('sortByLastname') }}">
                                        <input type="hidden" name="sortByDateSubmitted" value="{{ request('sortByDateSubmitted') }}">
                                        <input type="hidden" name="page" value="{{ request('page') }}">
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                        <div class="col-md-8">
                                            <input name="{{ $field }}" type="file" accept="{{ $informationAcceptType[$field] }}" class="form-control" required>
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
                    @endforeach

                    <hr>

                    @php
                        $callSamplesFields = ['inbound_call', 'outbound_call'];

                        $callSampleLabels = [
                                            'inbound_call' => 'Inbound Call',
                                            'outbound_call' => 'Outbound Call',
                                            ];
                        $appliedPosition = $user->information->positions ?? '';
                        $cleanPositions = str_replace(['[', ']'], '', $appliedPosition);
                        $notRequired = " not required.";
                        $required = " required.";
                    @endphp
                    @if(!isset($user->mockcalls))
                        <h6 class="text-center mb-3">Applicant has no mockcall files, upload below</h6>
                        <p>Applied positions: {{ $cleanPositions }}
                            @if(strpos($cleanPositions, "Callers") !== false)
                                <span class="badge badge-danger"> {{ $required }} </span>
                            @else
                                <span class="badge badge-info"> {{ $notRequired }}
                            @endif
                        </p>
                        @foreach ($callSamplesFields as $field)
                            <div class="row pb-3">
                                <label class="form-label px-3">{{ $callSampleLabels[$field] }}</label>
                                <form method="post" action="{{ route('update.user.storeFile', ['field' => $field]) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                    @csrf
                                    <input type="hidden" name="display" value="{{ request('display') }}">
                                    <input type="hidden" name="sortByFirstname" value="{{ request('sortByFirstname') }}">
                                    <input type="hidden" name="sortByLastname" value="{{ request('sortByLastname') }}">
                                    <input type="hidden" name="sortByDateSubmitted" value="{{ request('sortByDateSubmitted') }}">
                                    <input type="hidden" name="page" value="{{ request('page') }}">
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <div class="col-md-8">
                                        <input name="{{ $field }}" type="file" accept=".mp4, .avi, .mkv, .mov, .wmv, .flv, .webm, .mpeg, .mp3, .wav, .aac, .flac, .ogg, .wma, .audio/x-m4a, .audio/mp4, .m4a" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <button type="submit" class="btn btn-outline-primary btn-sm" class="p-1 text-danger">
                                            Update <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <h6 class="form-label">Mock Calls:
                            @if(strpos($cleanPositions, "Callers") !== false)
                                <span class="badge badge-danger"> {{ $required }} </span>
                            @else
                                <span class="badge badge-info"> {{ $notRequired }} </span>
                            @endif
                        </h6>
                        <p>Applied positions: {{ $cleanPositions }}

                        </p>
                        @foreach ($callSamplesFields as $field)
                            <div class="row pb-3">
                                <div class="col">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-4">

                                            <label class="form-label">{{ $callSampleLabels[$field] }}</label>
                                        </div>
                                            @if(!isset($user->mockcalls->$field) && is_null($user->mockcalls->$field))
                                                <div class="col text-right">
                                                    <span class="p-1 badge badge-danger"> N/A </span>
                                                </div>
                                            @else
                                                <div class="col-md-4 text-right">
                                                    <a href="{{ route('view.pdf', $user->mockcalls->$field)}}" class="p-1" target="_blank">Open<i class="bi bi-folder2-open ml-1"></i></a>
                                                </div>
                                                @if(isset($user->mockcalls->$field) && !is_null($user->mockcalls->$field))
                                                    <div class="col-md-4 text-right">
                                                        <form method="post" action="{{ route('update.user.deleteFile', ['id' => $user->mockcalls->id, 'field' => $field]) }}" class="deleteAdminForm filesDelete">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="display" value="{{ request('display') }}">
                                                            <input type="hidden" name="sortByFirstname" value="{{ request('sortByFirstname') }}">
                                                            <input type="hidden" name="sortByLastname" value="{{ request('sortByLastname') }}">
                                                            <input type="hidden" name="sortByDateSubmitted" value="{{ request('sortByDateSubmitted') }}">
                                                            <input type="hidden" name="page" value="{{ request('page') }}">
                                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                                            <button type="submit" class="btn text-danger" class="p-1 text-danger">
                                                                Delete <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
                                    </div>
                                    <div class="row">
                                        <form method="post" action="{{ route('update.user.updateFile', ['id' => $user->mockcalls->id, 'field' => $field]) }}" enctype="multipart/form-data" class="form-inline filesUpdate">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="display" value="{{ request('display') }}">
                                            <input type="hidden" name="sortByFirstname" value="{{ request('sortByFirstname') }}">
                                            <input type="hidden" name="sortByLastname" value="{{ request('sortByLastname') }}">
                                            <input type="hidden" name="sortByDateSubmitted" value="{{ request('sortByDateSubmitted') }}">
                                            <input type="hidden" name="page" value="{{ request('page') }}">
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                            <div class="col-md-8">
                                                <input name="{{ $field }}" type="file" accept=".mp4, .avi, .mkv, .mov, .wmv, .flv, .webm, .mpeg, .mp3, .wav, .aac, .flac, .ogg, .wma, .wma , .audio/x-m4a, .audio/mp4, .m4a" class="form-control" required>
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
                        @endforeach
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

