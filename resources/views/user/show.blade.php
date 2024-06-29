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

                    <div class="row p-2">
                        <div class="col">
                            @if (!isset($user->information->photo_id))
                                N/A
                            @else
                                <img src="{{ asset('storage/' . $user->information->photo_formal) }}" alt="formal photo" height="250px" class="border border-primary">
                            @endif
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Name:</div>
                        <div class="col-md-3">{{ $user->name}}</div>

                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Last Name:</div>
                        <div class="col-md-9">{{ $user->lastname }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Age:</div>
                        <div class="col-md-9">{{ $user->age }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Contact Number:</div>
                        <div class="col-md-9">{{ $user->contactnumber }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Educational attainment:</div>
                        <div class="col-md-9">{{ $user->education }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Email:</div>
                        <div class="col-md-9">{{ $user->email }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Gender:</div>
                        <div class="col-md-9">{{ $user->gender }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Address:</div>
                        <div class="col-md-9">{{ $user->address }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Skype:</div>
                        <div class="col-md-9">{{ $user->information->skype ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Niche:</div>
                        <div class="col-md-9">{{ $user->information->niche ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Happy Rate:</div>
                        <div class="col-md-9">{{ $user->information->rate ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Video introduction link:</div>
                        <div class="col-md-9">{{ $user->information->videolink ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Portfolio link:</div>
                        <div class="col-md-9">{{ $user->information->portfolio ?? 'N/A'}}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Union bank Account:</div>
                        <div class="col-md-3">{{ $user->information->ub_number ?? 'N/A' }}</div>
                        <div class="col-md-6">{{ $user->information->ub_account ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Years of experience:</div>
                        <div class="col-md-9">{{ $user->information->experience ?? 'N/A' }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">ID Attachments:</div>

                        @if (!isset($user->information->photo_id))
                            <div class="col-md-9"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-9"><a href="{{ route('view.pdf', $user->information->photo_id) }}" target="_blank">Click here</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Formal Photos</div>

                        @if (!isset($user->information->photo_formal))
                            <div class="col-md-9"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-9"><a href="{{ route('view.pdf', $user->information->photo_formal) }}" target="_blank">Click here</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">DISC results attachment:</div>

                        @if (!isset($user->information->disc_results))
                            <div class="col-md-9"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-9"><a href="{{ route('view.pdf', $user->information->disc_results) }}" target="_blank">Click here</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Resume attachment:</div>

                        @if (!isset($user->information->resume))
                            <div class="col-md-9"><a href="#">N/A</a></div>
                        @else
                            <div class="col-md-9"><a href="{{ route('view.pdf', $user->information->resume) }}" target="_blank">Click here</a></div>
                        @endif
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Registered:</div>
                        <div class="col-md-9">{{ $user->created_at->diffForHumans() }}</div>
                    </div>

                    @if(is_null($aWebsites))
                        <div class="row my-4 p-4 border rounded border-line border-secondary">
                            <div class="text-center">
                                <h3>No <span class="text-danger">Skillset</span> added yet.</h3>
                                <p class="pt-3">Click the <span class="text-info">"Dashboard"</span> and add skillset on specified fields.</p>
                            </div>
                        </div>
                    @else
                        <div class="row my-4 p-3">
                            <h3>Skillset:</h3>
                            <div class="table-responsive">
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


@endsection
