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
{{--
                    <div class="row p-2">
                        <div class="col-md-6">
                            @if (!isset($user->information->photo_id))
                                N/A
                            @else
                                <img src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="formal photo" height="250px" class="border border-primary">
                            @endif
                        </div>
                    </div> --}}

                    <div class="row p-2">
                        <div class="col-md-3">Name:</div>
                        <div class="col-md-3">{{ $user->name}} {{ $user->lastname }}</div>

                        <div class="col-md-6 text-right">
                            @if (!isset($user->information->photo_id))
                                N/A
                            @else
                                <img src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="formal photo" height="250px" class="border border-primary">
                            @endif
                        </div>
                    </div>
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

                        <div class="col-md-3">Educational attainment:</div>
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

                        <div class="col-md-3">Years of experience:</div>
                        <div class="col-md-3">{{ $user->information->experience ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Union bank Account:</div>
                        <div class="col-md-3">
                            {{ $user->information->ub_account ?? 'N/A' }} -
                            {{ $user->information->ub_number ?? 'N/A' }}
                        </div>
                    </div>
                    <hr>

                    <div class="row p-2">
                        <div class="col-md-3">ID Attachments:</div>

                        @if (!isset($user->information->photo_id))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->photo_id) }}" target="_blank">Open File</a></div>
                        @endif

                        <div class="col-md-3">Formal Photos</div>

                        @if (!isset($user->information->photo_formal))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->photo_formal) }}" target="_blank">Open File</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">DISC results attachment:</div>

                        @if (!isset($user->information->disc_results))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->disc_results) }}" target="_blank">Open File</a></div>
                        @endif

                        <div class="col-md-3">Resume attachment:</div>

                        @if (!isset($user->information->resume))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->resume) }}" target="_blank">Open File</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Video introduction:</div>

                        @if (!isset($user->information->videolink))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->videolink) }}" target="_blank">Open File</a></div>
                        @endif

                        <div class="col-md-3">Portfolio:</div>

                        @if (!isset($user->information->portfolio))
                            <div class="col-md-3"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-3"><a href="{{ route('view.pdf', $user->information->portfolio) }}" target="_blank">Open File</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Applying as: </div>
                        <div class="col-md-3">
                            @if(is_null($aPositionsApplied))
                                N/A
                            @else
                                @foreach($aPositionsApplied as $index => $position)
                                    {{ $position }} </br>
                                @endforeach
                            @endif
                        </div>

                        <div class="col-md-3">Registered:</div>
                        <div class="col-md-3">{{ $user->created_at->diffForHumans() }}</div>
                    </div>

                    @if (isset($user->mockcalls))
                        <div class="row p-2">
                            <div class="col-md-3">
                                <strong>HR Sample mock calls:</strong>
                            </div>
                            <div class="col-md-3">
                                <a href="#mock-call-modal" class="btn btn-outline-primary btn-sm px-5" data-bs-toggle="modal">Edit</a>
                            </div>
                        </div>

                        <div class="row p-2" id="callersRow">
                            <div class="col-md-3" id="inboundLabel">
                                <label> Inbound: </label>
                            </div>
                            <div class="col-md-3" id="inboundLink">
                                <a href="{{ route('view.pdf', $user->mockcalls->inbound_call) }}" target="_blank">Open</a>
                            </div>

                            <div class="col-md-3" id="outboundLabel">
                                <label> Outbound: </label>
                            </div>
                            <div class="col-md-3" id="outboundLink">
                                <a href="{{ route('view.pdf', $user->mockcalls->outbound_call) }}" target="_blank">Open</a>
                            </div>
                        </div>
                    @endif

                    <hr>

                    @if(is_null($aWebsites))
                        <div class="row my-4 p-4 border rounded border-line border-secondary">
                            <div class="text-center">
                                <h5>No <span class="text-danger">Skillsets</span> added yet.</h5>
                            </div>
                        </div>
                    @else
                        <div class="row mt-4 p-3">
                            <div class="col">
                                <h5>Skillset details</h5>
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
                            last updated last: {{ $user->information->updated_at->diffForHumans(); }}
                        </small>
                    </div>
                    @endif

                    @if($user->experiences->count() < 1)
                        <div class="row my-4 p-4 border rounded border-line border-secondary">
                            <div class="text-center">
                                <h5>No <span class="text-danger">Experiences</span> added yet.</h5>
                                <p class="pt-3">Please fill up the fields on the <span class="text-info">"Dashboard"</span> page.</p>
                            </div>
                        </div>
                    @else
                        <div class="row mt-4 p-3">
                            <div class="col">
                                <h5>Experience details</h5>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#create-details-modal">Add more</button>
                            </div>

                            <div class="table-responsive mt-2">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th scope="col">Job Experience</th>
                                        <th scope="col">Duration</th>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

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
<x-applicant.mock-call />

@endsection
