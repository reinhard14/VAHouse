@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Account Details:
                </div>

                <div class="card-body">
                    @include('includes.messages')

                    <div class="row p-2 justify-content-center">
                        <div class="col-md-6 d-flex justify-content-center">
                            <div class="card p-3">
                                {{-- <div class="text-center"> --}}
                                @if (!isset($user->information->photo_id) || is_null($user->information->photo_id))
                                    <img class="img-fluid rounded-circle" src="{{ asset('dist/img/user_default.png') }}" alt="default photo" style="height: 225px; width: 225px;">
                                @else
                                    <div class="text-center">
                                        <img class="img-fluid rounded-circle" src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="formal photo" style="height: auto; width: 225px;">
                                    </div>
                                @endif
                                {{-- </div> --}}

                                {{-- @if (!isset($user->information->photo_id) || is_null($user->information->photo_id))
                                    N/A
                                @else
                                    <img src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="formal photo" height="250px" class="border border-primary">
                                @endif --}}
                                <h3 class="text-muted text-center">{{ $user->name }} {{ $user->middlename }} {{ $user->lastname }} {{ $user->suffix ?? ''}} </h3>

                                <p class="text-muted text-center">{{ $user->experiences->last()->title ?? 'unavailable'}}</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row p-2">
                        <div class="col-md-3">Gender:</div>
                        <div class="col-md-3">{{ $user->gender }}</div>

                        <div class="col-md-3">Age:</div>
                        <div class="col-md-3">{{ $user->age }}</div>

                    </div>
                    <div class="row p-2">
                        <div class="col-md-3">Contact Number:</div>
                        <div class="col-md-3">{{ $user->contactnumber }}</div>

                        <div class="col-md-3">Email:</div>
                        <div class="col-md-3">{{ $user->email }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Address:</div>
                        <div class="col-md-3">{{ $user->address }}</div>

                        <div class="col-md-3">Educational Attainment:</div>
                        <div class="col-md-3">{{ $user->education }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Skype:</div>
                        <div class="col-md-3">{{ $user->information->skype ?? 'N/A' }}</div>

                        <div class="col-md-3">Niche:</div>
                        <div class="col-md-3">{{ $user->information->niche ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Happy Rate:</div>
                        <div class="col-md-3">{{ $user->information->rate ?? 'N/A' }}</div>

                        <div class="col-md-3">Years of Experience:</div>
                        <div class="col-md-3">{{ $user->information->experience ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Union Bank Account:</div>
                        <div class="col-md-3">
                            {{ $user->information->ub_account ?? 'N/A' }} -
                            {{ $user->information->ub_number ?? 'N/A' }}
                        </div>

                        <div class="col-md-3">Registered:</div>
                        <div class="col-md-3">{{ $user->created_at->format('M d, Y') }}</div>
                    </div>
                    <hr>

                    <div class="row p-2">
                        <div class="col-md-3">ID Attachments:</div>

                        @if (!isset($user->information->photo_id) || is_null($user->information->photo_id))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->photo_id) }}" target="_blank">Open File</a></div>
                        @endif

                        <div class="col-md-3">Formal Photos</div>

                        @if (!isset($user->information->photo_formal) || is_null($user->information->photo_formal))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->photo_formal) }}" target="_blank">Open File</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">DISC Results Attachment:</div>

                        @if (!isset($user->information->disc_results) || is_null($user->information->disc_results))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->disc_results) }}" target="_blank">Open File</a></div>
                        @endif

                        <div class="col-md-3">Resume Attachment:</div>

                        @if (!isset($user->information->resume) || is_null($user->information->resume))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->resume) }}" target="_blank">Open File</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Video Introduction:</div>

                        @if (!isset($user->information->videolink) || is_null($user->information->videolink))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->videolink) }}" target="_blank">Open File</a></div>
                        @endif

                        <div class="col-md-3">Portfolio:</div>

                        @if (!isset($user->information->portfolio) || is_null($user->information->portfolio))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->portfolio) }}" target="_blank">Open File</a></div>
                        @endif
                    </div>

                    <hr>

                    @if (isset($user->mockcalls))
                        <div class="row p-2">
                            <div class="col-md-3">
                                <strong>HR Sample Mock Calls:</strong>
                            </div>
                            <div class="col-md-3">
                                <a href="#mock-call-modal" class="btn btn-outline-primary btn-sm px-5" data-bs-toggle="modal">Edit</a>
                            </div>

                            <div id="inboundLabel" class="col-md-3">
                                <label> Inbound: </label>
                            </div>
                            <div id="inboundLink" class="col-md-3">
                                <a href="{{ route('view.pdf', $user->mockcalls->inbound_call ?? '') }}" target="_blank">Open</a>
                            </div>
                        </div>

                        <div id="callersRow" class="row p-2 justify-content-end">
                            <div id="outboundLabel" class="col-md-3">
                                <label> Outbound: </label>
                            </div>
                            <div id="outboundLink" class="col-md-3">
                                <a href="{{ route('view.pdf', $user->mockcalls->outbound_call ?? '') }}" target="_blank">Open</a>
                            </div>
                        </div>
                    @endif

                    @if (isset($user->references))
                        <div class="row p-2">
                            <div class="col-md-3">
                                <strong>
                                    Applying as:
                                </strong>
                            </div>
                            <div class="col-md-3">
                                @if(is_null($aPositionsApplied))
                                    N/A
                                @else
                                    @foreach($aPositionsApplied as $index => $position)
                                        {{ $position }} </br>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-3">
                                <strong>References:</strong>
                            </div>
                            <div class="col-md-3">
                                <a href="#view-references-modal-{{ Auth::id() }}" class="btn btn-outline-primary btn-sm px-5" data-bs-toggle="modal">View</a>
                            </div>
                        </div>
                    @endif

                    <hr>

                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#skillset" data-toggle="tab">Skillset</a></li>
                                <li class="nav-item"><a class="nav-link" href="#experience" data-toggle="tab">Experience</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="skillset">
                                    @if(is_null($aWebsites))
                                        <div class="row">
                                            <div class="text-center">
                                                <h5>No <span class="text-danger">Skillsets</span> added yet.</h5>
                                                <p class="pt-3">Please fill up the fields on the <span class="text-info">"Dashboard"</span> page.</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col">
                                                <h5>Skillset Details</h5>
                                            </div>

                                            <div class="table-responsive mt-2">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                        <th scope="col">Websites</th>
                                                        <th scope="col">Tools</th>
                                                        <th scope="col">Skills</th>
                                                        <th scope="col">Soft skill</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row">
                                                                @foreach($aWebsites as $index => $scoreData)
                                                                    {{ $scoreData }} </br>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach($aTools as $index => $scoreData)
                                                                    {{ $scoreData }} </br>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach($aSkills as $index => $scoreData)
                                                                    {{ $scoreData }} </br>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @if(is_null($aSoftskills))
                                                                    No data available.
                                                                @else
                                                                    @foreach($aSoftskills as $index => $scoreData)
                                                                        {{ $scoreData }} </br>
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <small>
                                                @if(isset($user->information))
                                                    last updated last: {{ $user->information->updated_at->diffForHumans(); }}
                                                @endif
                                            </small>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="experience">
                                    @if($user->experiences->count() < 1)
                                        <div class="row">
                                            <div class="text-center">
                                                <h5>No <span class="text-danger">Experiences</span> added yet.</h5>
                                                <p class="pt-3">Please fill up the fields on the <span class="text-info">"Dashboard"</span> page.</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col">
                                                <h5>Years of experience details</h5>
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#create-details-modal">Add Experience</button>
                                            </div>

                                            <div class="table-responsive mt-2">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                        <th scope="col">Job Experience</th>
                                                        <th scope="col">Duration</th>
                                                        <th scope="col" class="text-end">Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="experienceRow">
                                                        @foreach($user->experiences as $experience)
                                                            <tr>
                                                                <td>
                                                                    {{ $experience->title }}
                                                                </td>
                                                                <td>
                                                                    {{ $experience->duration }}
                                                                </td>
                                                                <td class="text-end">
                                                                    <form method="post" action="{{ route('user.experienceDelete', $experience->id) }}" class="deleteExperienceForm">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash mr-1"></i>Delete</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <small>
                                                @if(isset($user->experiences))
                                                    last updated last: {{ $user->experiences->last()->updated_at->diffForHumans(); }}
                                                @endif
                                            </small>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.tab-pane attachments-->
                            </div>
                        <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>








                    <div class="row mt-5">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary mr-2"><i class="bi bi-save me-1"></i>Edit</a>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-return-right me-1"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<x-applicant.details />
<x-applicant.view-references :user="$user" />
<x-applicant.mock-call />

<script src="{{ asset('dist/js/pages/user-end/show.js') }}"> </script>
@endsection
