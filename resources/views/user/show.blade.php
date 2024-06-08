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
                        <div class="col-md-3">Name:</div>
                        <div class="col-md-9">{{ $user->name}}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Last Name:</div>
                        <div class="col-md-9">{{ $user->lastname }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Email:</div>
                        <div class="col-md-9">{{ $user->email }}</div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Registered:</div>
                        <div class="col-md-9">{{ $user->created_at }}</div>
                    </div>

                    @if(is_null($aWebsites))
                        nah, i'd win!
                    @else
                        {{-- <button type="button" class="btn btn-outline-primary mb-2" data-bs-target="#collapseAlert" data-bs-toggle="collapse">Show</button>
                        <div class="collapse show" id="collapseAlert"> --}}
                            <div class="row my-4 p-3">
                                <h3>Skillset:</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                            <th scope="col">Websites</th>
                                            <th scope="col">Applications</th>
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
                                                    @foreach($aApplications as $index => $scoreData)
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
                                                    @foreach($aSoftskills as $index => $scoreData)
                                                        {{ $scoreData }} </br>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    <div class="row mb-5 py-5">
                        <div class="col">
                            <div class="form-row">
                                <div class="col text-right p-2">
                                    <label for="attachment">Attach resume here: </label>
                                </div>
                                <div class="col p-2">
                                    <input type="button" onclick="alert('Insert attachment!')" value="attachment" class="btn btn-info btn-sm">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col text-right">
                                    <label for="attachment">Attach image here: </label>
                                </div>
                                <div class="col">
                                    <input type="button" onclick="alert('Insert picture here!')" value="image" class="btn btn-info btn-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary mr-2"><i class="bi bi-save me-1"></i>Edit</a>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-return-right me-1"></i>Back</a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <small>
                            last updated last: {{ $user->scores->updated_at->diffForHumans(); }}
                        </small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('dist/js/pages/user/form.js') }}"></script>
@endsection
