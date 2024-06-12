@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Edit Account Details:
                </div>

                <div class="card-body">
                    @include('includes.messages')

                    <div class="row p-2">
                        <div class="col-md-3">Name:</div>
                        <div class="col-md-9">
                            <input type="text" value="{{ $user->name}}" class="form-control">
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Last Name:</div>
                        <div class="col-md-9">
                            <input type="text" value="{{ $user->lastname}}" class="form-control">
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-3">Email:</div>
                        <div class="col-md-9">
                            <input type="text" value="{{ $user->email}}" class="form-control">
                        </div>
                    </div>

                    {{-- <div class="row mb-5 py-5">
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
                    </div> --}}

                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="bi bi-save me-1"></i> Update</button>
                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary"><i class="bi bi-arrow-return-right me-1"></i>Back</a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <small>
                            last updated last: {{ $user->scores->updated_at->diffForHumans(); }}
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('dist/js/pages/user/form.js') }}"></script>

@endsection
